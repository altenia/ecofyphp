<?php namespace Altenia\Ecofy\Controller;

use \Altenia\Ecofy\QueryContext;

/**
 * Controller class that provides web access to resource
 *
 */
class GenericServiceController extends \BaseController {

    // The service object
	protected $service;

	protected $modelName;
	protected $modelNamePlural;

	// Same as modelName but in snake case
	protected $moduleName;
	protected $moduleNamePlural;

	protected $layout;

	/**
	 * Constructor
	 */
	public function __construct($layoutName, $serviceInstanceName, $modelName, $modelNamePlural = null) {
		parent::__construct();
		$this->modelName = ucfirst($modelName);
		$this->modelNamePlural = ($modelNamePlural != null) ? ucfirst($modelNamePlural) : $this->modelName . 's';
		
		$this->moduleName = snake_case($modelName);
		$this->moduleNamePlural = snake_case($this->modelNamePlural);

        $this->service = App::make($serviceInstanceName);

		$this->layout = $layoutName;
		$this->addBreadcrumb([Lang::get($this->moduleName . '._name_plural'), route($this->moduleNamePlural . '.index')]);
		$this->setContentTitle(Lang::get($this->moduleName . '._name_plural'));
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

		$listMethod = 'list' . $this->modelNamePlural;
		$records = $this->service->$listMethod($criteria, array(), $queryCtx->getOffset(), $queryCtx->limit);
		$this->layout->content = View::make($this->moduleName . '.index')
			->with('queryCtx', $queryCtx)
			->with('auxdata', $this->indexAuxData())
		    ->with('records', $records);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$this->addBreadcrumb(['new']);
		$this->setContentTitle('New ' . Lang::get($this->moduleName . '._name') );

		$this->layout->content = View::make($this->moduleName . '.create')
			->with('auxdata', $this->createAuxData());
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$data = Input::all();

		try {
			$createMethod = 'create' . $this->modelName;
            $record = $this->service->$createMethod($data);
            Session::flash('message', 'Successfully created!');
            
            return $this->redirectAfterPost(
            	array('save' => route($this->moduleNamePlural . '.edit', array($record->sid))),
            	route($this->moduleNamePlural . '.index')
            	);
        } catch (Service\ValidationException $ve) {
            return Redirect::to( route($this->moduleNamePlural . '.create'))
                ->withErrors($ve->getObject());
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

		$this->addBreadcrumb([$record->getName(), Request::url()]);
		$this->setContentTitle(Lang::get($this->moduleName . '._name') . ' - ' .  $record->getName());

		$this->layout->content = View::make($this->moduleName . '.show')
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

	    $showUrl = URL::to(route($this->moduleNamePlural . '.show', array($record->sid)));
		$this->addBreadcrumb([$record->getName(), $showUrl]);
		$this->setContentTitle(Lang::get($this->moduleName . '._name') . ' - ' .  $record->getName());

		$this->layout->content = View::make($this->moduleName . '.edit')
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

		$data = Input::all();
		
		try {
			$updateMethod = 'update' . $this->modelName;
            $record = $this->service->$updateMethod($id, $data);
            Session::flash('message', 'Successfully updated!');

            return $this->redirectAfterPost(
            	array('save' => route($this->moduleNamePlural . '.edit', array($record->sid))),
            	route($this->moduleNamePlural . '.index')
            	);
        } catch (Service\ValidationException $ve) {
            return Redirect::to(route($this->moduleNamePlural . '.edit', array($id)))
                ->withErrors($ve->getObject());
        } /* catch (Exception $e) {
            return Redirect::to('users/' . $id . '/edit')
                ->withErrors($e->getMessage());
                //->withInput(Input::except('password'));
        }*/
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
            Session::flash('message', 'Successfully deleted!');
            return Redirect::to($this->moduleNamePlural);
        } else {
            Session::flash('message', 'Entry not found');
            return Redirect::to($this->moduleNamePlural);
        }
	}

	/**
	 * Method to return values that 
	 * Overridable 
	 */
	public function indexAuxData() {
		return null;
	}

	/**
	 * Method to return values that 
	 * Overridable 
	 */
	public function createAuxData() {
		return null;
	}

	/**
	 * Method to return values that 
	 * Overridable 
	 */
	public function showAuxData($record) {
		return null;
	}

	/**
	 * Method to return values that 
	 * Overridable 
	 */
	public function editAuxData($record) {
		return null;
	}
 
}
