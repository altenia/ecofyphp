<?php namespace Altenia\Ecofy\Controller;

use Altenia\Ecofy\Support\QueryContext;
//use Illuminate\Support\Facades\Response;
//use Illuminate\Support\Facades\Input;

/**
 * Controller class that provides Generic Service REST API
 * The service must adhere to the method naming convetion.
 *
 */
class GenericNestedServiceApiController extends BaseController {

    // The service object
	protected $service;

	protected $modelName;
	protected $modelNamePlural;

	/**
	 * The name of foreign key that is referencing the container's object
	 */
	protected $foreignKeyProperty;

	/**
	 * Constructor
	 */
	public function __construct($serviceInstanceName, $foreignKeyProperty, $modelName, $modelNamePlural = null) {
		$this->modelName = ucfirst($modelName);
		$this->modelNamePlural = ($modelNamePlural != null) ? ucfirst($modelNamePlural) : $this->modelName . 's';
        $this->service = \App::make($serviceInstanceName);

        $this->foreignKeyProperty = $foreignKeyProperty;
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($containerRecordSid)
	{
		$queryCtx = new QueryContext(true);
		$queryCtx->qparams[$this->foreignKeyProperty] = $containerRecordSid;
		$criteria = $queryCtx->buildCriteria();

		$listMethod  = 'list' . $this->modelNamePlural;
		$countMethod = 'count' . $this->modelNamePlural;

		$records = $this->service->$listMethod($criteria, array(), $queryCtx->getOffset(), $queryCtx->limit);

		$result = null;
		if ($queryCtx->envelop) {
			$result = $queryCtx->toArray();
			$result['records'] = $records->toArray();
			$result['total_match'] = $this->service->$countMethod($criteria);
		} else {
			$result = $records->toArray();
		}

		return $this->toJson($result);
	}

	/**
	 * Showing the form is not supported
	 *
	 */
	public function create($containerRecordSid)
	{
		\App::abort(404);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store($containerRecordSid)
	{
		$data = \Input::all();
		$data[$this->foreignKeyProperty] = $containerRecordSid;

		$createMethod = 'create' . $this->modelName;

        try {
        	$this->beforeRecordCreate($data);
            $record = $this->service->$createMethod($data);
            $this->afterRecordCreate($record);
            return \Response::json(array(
                'sid' => $record->sid),
                201
            );
        } catch (Exception $e) {
            return Response::json(array(
                'error' => $e->getMessage()),
                400
            );
        }
	}

	/**
	 * Return JSON representation of the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($containerRecordSid, $id)
	{
		$findMethod = 'find' . $this->modelName . 'ByPK';

		$record = $this->service->$findMethod($id);

		return $record;
	}

	/**
	 * Showing the form is not supported in API.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($containerRecordSid, $id)
	{
	    \App::abort(404);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($containerRecordSid, $id)
	{
		$data = \Input::all();
		//$data[$this->foreignKeyProperty] = $containerRecordSid;

        $updateMethod = 'update' . $this->modelName;

        try {
			$this->beforeRecordUpdate($data);
            $record = $this->service->$updateMethod($id, $data);
            $this->afterRecordUpdate($record);
            return \Response::json(array(
                'sid' => $record->sid),
                200
            );
        } catch (Exception $e) {
            return \Response::json(array(
                'error' => $e->getMessage()),
                400
            );
        }
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($containerRecordSid, $id)
	{
		$deleteMethod = 'destroy' . $this->modelName;
		$result = $this->service->$deleteMethod($id);

		if (!empty($result)) {
			\Log::debug('Removing ' . $this->modelName . ': ' . $result->getName());
		} else {
			\Log::info($this->modelName .' record ' . $id . ' not found');
		}

		if (!empty($result)) {
		    return \Response::json(array(
                'removed' => $id),
                204
            );
		} else {
		    \App::abort(404);
		}
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
}

