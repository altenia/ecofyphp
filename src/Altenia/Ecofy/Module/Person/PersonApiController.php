<?php namespace Altenia\Ecofy\Module\Person;

use Altenia\Ecofy\Controller\GenericServiceApiController;
use Altenia\Ecofy\Support\QueryContext;

/**
 * Controller class that provides REST API to Person resource
 *
 * @todo: Add following line in app/routes.php
 * Route::resource('persons', 'PersonController');
 */
class PersonApiController extends GenericServiceApiController {

	public function __construct() {
		parent::__construct('svc:person', 'Person');
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

		$listMethod  = 'list' . $this->modelNamePlural . 'OrderByFamily';
		$countMethod = 'count' . $this->modelNamePlural;

		$sortParams = array('hof_person.name_nl' => 'asc'
			,'persons.id' => 'asc');
		$records = $this->service->$listMethod($criteria, $sortParams, $queryCtx->getOffset(), $queryCtx->limit);

		//print_r($records);
		//die();

		$queries    = \DB::getQueryLog();
		$last_query = ($queries);
		\Log::info($last_query);

		$result = null;
		if ($queryCtx->envelop) {
			$result = $queryCtx->toArray();
			$result['records'] = $records->toArray();
			$result['total_match'] = $this->service->$countMethod($criteria);
		} else {
			$result = $records->toArray();
		}

		$queries    = \DB::getQueryLog();
		$last_query = ($queries);
		\Log::info($last_query);

		return $this->toJson($result);
	}
}