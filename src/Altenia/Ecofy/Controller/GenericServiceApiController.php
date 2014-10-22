<?php namespace Altenia\Ecofy\Controller;

use Altenia\Ecofy\Support\QueryContext;
//use Illuminate\Support\Facades\Response;
//use Illuminate\Support\Facades\Input;

/**
 * Controller class that provides Generic Service REST API
 * The service must adhere to the method naming convetion.
 *
 */
class GenericServiceApiController extends \BaseController {

    // The service object
	protected $service;

	protected $modelName;
	protected $modelNamePlural;

	/**
	 * Constructor
	 */
	public function __construct($serviceInstanceName, $modelName, $modelNamePlural = null) {
		$this->modelName = ucfirst($modelName);
		$this->modelNamePlural = ($modelNamePlural != null) ? ucfirst($modelNamePlural) : $this->modelName . 's';
        $this->service = \App::make($serviceInstanceName);
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
	public function create()
	{
		\App::abort(404);
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
            $record = $this->service->$createMethod($data);
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
	public function show($id)
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
	public function edit($id)
	{
	    \App::abort(404);
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

        try {
        	$updateMethod = 'update' . $this->modelName;
            $record = $this->service->$updateMethod($id, $data);
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
	public function destroy($id)
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
}

