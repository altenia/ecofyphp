<?php namespace Altenia\Ecofy\Controller;

use Altenia\Ecofy\Support\QueryContext;
use Altenia\Ecofy\Service\ValidationException;

use Illuminate\Routing\Redirector;
use Illuminate\Translation\Translator; // Lang()
use Illuminate\Session\SessionManager; // Session()
use Illuminate\View\Factory; // View()

/**
 * Controller class that provides web access to resource
 *
 */
class GenericServiceController extends BaseController {

    // The service object
	protected $service;

	protected $modelName;
	protected $modelNamePlural;

	// Same as modelName but in snake case
	protected $moduleName;
	protected $moduleNamePlural;

	protected $indexRetrievalMethod = 'list';

	protected $layout;

	/**
	 * Registry of response factories, which renders format other than HTML.
	 * @type array
	 */
	protected $responseFactories = array();

	/**
	 * Constructor
	 */
	public function __construct($layoutName, $serviceInstanceName, $modelName, $modelNamePlural = null) {
		parent::__construct();
		$this->modelName = ucfirst($modelName);
		$this->modelNamePlural = ($modelNamePlural != null) ? ucfirst($modelNamePlural) : $this->modelName . 's';
		
		$this->moduleName = snake_case($modelName);
		$this->moduleNamePlural = snake_case($this->modelNamePlural);

		// @todo - change to use ServiceRegistry
        $this->service = \App::make($serviceInstanceName);

		$this->layout = $layoutName;
		$this->addBreadcrumb([\Lang::get($this->moduleName . '._name_plural'), route($this->moduleNamePlural . '.index')]);
		$this->setContentTitle(\Lang::get($this->moduleName . '._name_plural'));
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$queryCtx = new QueryContext(true);
		$criteria = $queryCtx->buildCriteria();

		$listMethod = $this->listMethod();

		$sortParams = $this->sortParams();
		$records = $this->service->$listMethod($criteria, $sortParams, $queryCtx->getOffset(), $queryCtx->limit);

		if ($queryCtx->format === null || $queryCtx->format === 'html') {
			$this->layout->content = \View::make($this->moduleName . '.index')
				->with('queryCtx', $queryCtx)
				->with('auxdata', $this->indexAuxData())
			    ->with('records', $records);
		} else {
			$response = $this->_response('index', $queryCtx->format, $queryCtx, $records);
			if ($response == null) {
				\App::abort(404);
				return;
			}
			return $response;
		}
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$this->addBreadcrumb(['new']);
		$this->setContentTitle('New ' . \Lang::get($this->moduleName . '._name') );

		$this->layout->content = \View::make($this->moduleName . '.create')
			->with('auxdata', $this->createAuxData());
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$data = \Input::all();

		$createMethod = 'create' . $this->modelName;

		try {
			$this->beforeRecordCreate($data);
            $record = $this->service->$createMethod($data);
            $this->afterRecordCreate($record);
            \Session::flash('message', 'Successfully created!');
            
            return $this->redirectAfterPost(
            	array('save' => route($this->moduleNamePlural . '.edit', array($record->sid))),
            	route($this->moduleNamePlural . '.index')
            	);
        } catch (ValidationException $ve) {
            return \Redirect::to( route($this->moduleNamePlural . '.create'))
                ->withErrors($ve->getObject())
                ->withInput();
        }
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$findMethod = 'find' . $this->modelName . 'ByPK';
		$record = $this->service->$findMethod($id);

		if ( empty($record )) {
			\App::abort(404);
				return;
		}

		$this->addBreadcrumb([$record->getName(), \Request::url()]);
		$this->setContentTitle(\Lang::get($this->moduleName . '._name') . ' - ' .  $record->getName());

		$this->layout->content = \View::make($this->moduleName . '.show')
			->with('auxdata', $this->showAuxData($record))
			->with('record', $record);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$findMethod = 'find' . $this->modelName . 'ByPK';
	    $record = $this->service->$findMethod($id);

	    $showUrl = \URL::to(route($this->moduleNamePlural . '.show', array($record->sid)));
		$this->addBreadcrumb([$record->getName(), $showUrl]);
		$this->setContentTitle(\Lang::get($this->moduleName . '._name') . ' - ' .  $record->getName());

		$this->layout->content = \View::make($this->moduleName . '.edit')
			->with('auxdata', $this->editAuxData($record))
		    ->with('record', $record);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$data = \Input::all();

		$updateMethod = 'update' . $this->modelName;
		
		try {
			$this->beforeRecordUpdate($data);
            $record = $this->service->$updateMethod($id, $data);
            $this->afterRecordUpdate($record);
            \Session::flash('message', 'Successfully updated!');

            return $this->redirectAfterPost(
            	array('save' => route($this->moduleNamePlural . '.edit', array($record->sid))),
            	route($this->moduleNamePlural . '.index')
            	);
        } catch (ValidationException $ve) {
            return \Redirect::to(route($this->moduleNamePlural . '.edit', array($id)))
                ->withErrors($ve->getObject());
        } 
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$deleteMethod = 'delete' . $this->modelName;
		$success = $this->service->$deleteMethod($id);

		if ($success) {
            \Session::flash('message', 'Successfully deleted!');
            return \Redirect::to($this->moduleNamePlural);
        } else {
            \Session::flash('message', 'Entry not found');
            return \Redirect::to($this->moduleNamePlural);
        }
	}

	/**
	 * returns response of a specific format
	 */
	protected function _response($action, $format, $queryCtx, &$records)
	{
		$rendName = $action . '/'. $format;
		if (array_key_exists($rendName, $this->responseFactories))
		{
			$responseFactory = $this->responseFactories[$rendName];
			return $responseFactory->makeResponse($queryCtx, $records);
		}
		return null;
	}

	/**
	 * The service method name to list on index
	 */
	protected function listMethod() {
		return $this->indexRetrievalMethod . $this->modelNamePlural;
	}

	/**
	 * Sort param
	 */
	protected function sortParams() {
		return array();
	}

	/**
	 * Method to return values that 
	 * Overridable 
	 */
	protected function indexAuxData() {
		return null;
	}

	/**
	 * Method to return values that 
	 * Overridable 
	 */
	protected function createAuxData() {
		return null;
	}

	/**
	 * Method to return values that 
	 * Overridable 
	 */
	protected function showAuxData(&$record) {
		return null;
	}

	/**
	 * Method to return values that 
	 * Overridable 
	 */
	protected function editAuxData(&$record) {
		return null;
	}


	/**
	 * Method that is called before creating
	 * @param array $data  the array fromwhich the record will be created
	 */
	protected function beforeRecordCreate(&$data) {

	}

	/**
	 * Method that is called after record is created
	 * @param object $record the record that was created
	 */
	protected function afterRecordCreate(&$record) {

	}

	/**
	 * Method that is called before creating
	 * @param array $data  the array fromwhich the record will be created
	 */
	protected function beforeRecordUpdate(&$data) {

	}

	/**
	 * Method that is called after record is created
	 * @param object $record the record that was created
	 */
	protected function afterRecordUpdate(&$record) {

	}
 
 	/**
 	 * Registers a new reponse factory
 	 */
 	protected function registerResponseFactory($name, $factory)
 	{
 		$this->responseFactories[$name] = $factory;
 	}
}
