<?php namespace Altenia\Ecofy\Module\Task;

use Altenia\Ecofy\Controller\GenericServiceApiController;

/**
 * Controller class that provides REST API to Task resource
 *
 * @todo: Add following line in app/routes.php
 * Route::resource('tasks', 'TaskController');
 */
class TaskLogEntryApiController extends GenericServiceApiController {

	public function __construct() {
		parent::__construct('svc:task_log_entry', 'TaskLogEntry', 'TaskLogEntries');
	}

	/**
	 * Method that is called before creating
	 * @param array $data  the array fromwhich the record will be created
	 */
	protected function beforeRecordCreate(&$data)
	{
		$data['allocation_date'] = new \DateTime( "midnight" );
	}
}