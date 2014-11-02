<?php namespace Altenia\Ecofy\Module\Task;

use Altenia\Ecofy\Controller\GenericServiceApiController;

/**
 * Controller class that provides REST API to Task resource
 *
 * @todo: Add following line in app/routes.php
 * Route::resource('tasks', 'TaskController');
 */
class TaskApiController extends GenericServiceApiController {

	public function __construct() {
		parent::__construct('svc:task', 'Task');
	}

}