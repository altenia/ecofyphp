<?php
/**
 * Models from schema: ecofy version 0.1
 * Code generated by TransformTask
 *
 */


/**
 * Controller class that provides REST API to SequenceNumber resource
 *
 * @todo: Add following line in app/routes.php
 * Route::resource('sequence_number', 'SequenceNumberApiController');
 */
class SequenceNumberApiController extends \BaseController {

    // The service object
	protected $sequenceNumberService;

	/**
	 * Constructor
	 */
	public function __construct() {
        //$this->sequence_numberService = new Service\SequenceNumberService();
        $this->sequenceNumberService = App::make('sequence_number_service');
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$queryCtx = new \DocuFlow\Helper\DfQueryContext(true);
		$criteria = $queryCtx->buildCriteria();

		$records = $this->sequenceNumberService->listSequenceNumbers($qparams, $offset, $limit);
		return $this->toJson($result);;
	}

	/**
	 * Showing the form is not supported
	 *
	 */
	public function create()
	{
		App::abort(404);
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
            $record = $this->sequenceNumberService->createSequenceNumber($data);
            return Response::json(array(
                'sid' => $record->sid),
                200
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
		$record = $this->sequenceNumberService->findSequenceNumber($id);

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
	    App::abort(404);
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
            $record = $this->sequenceNumberService->updateSequenceNumber($id, $data);
            return Response::json(array(
                'sid' => $record->sid),
                200
            );
        } catch (Exception $e) {
            return Response::json(array(
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
		// delete
		$result = $this->sequenceNumberService->destroySequenceNumber($id, $data);

		if ($result) {
		    return Response::json(array(
                'error' => false),
                200
            );
		} else {
		    App::abort(404);
		}
	}
}
