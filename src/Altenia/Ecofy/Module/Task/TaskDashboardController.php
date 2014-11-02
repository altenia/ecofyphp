<?php namespace Altenia\Ecofy\Module\Task;
/**
 * Models from schema: AldosEngine version 0.1
 * Code generated by TransformTask
 *
 */

use Altenia\Ecofy\Controller\BaseController;
use Altenia\Ecofy\Service\ServiceRegistry;

/**
 * Controller class that provides REST API to Task resource
 */
class TaskDashboardController extends BaseController {

	protected $layout = 'layouts.workspace';

	/**
	 * Tash dashboard
	 */
	public function showPage()
	{

		if (!\Auth::check()) {
			\Session::flash('message', 'No permission. Sign-in first.') ;
			return \Redirect::to('auth/nopermission');
			\App::abort(401);
		}
		
		$auxdata['opt_status'] = array(
				'0' => \Lang::get('task.status_defined'), 
				'1' => \Lang::get('task.status_allocated'), 
				'2' => \Lang::get('task.status_completed')
			);
		$auxdata['opt_record_status'] = array(
				'0' => \Lang::get('task.record_status_accessible'), 
				'1' => \Lang::get('task.record_status_deleted'), 
				'2' => \Lang::get('task.record_status_archived')
			);

		$this->addBreadcrumb([\Lang::get('task._name_plural'), '/tasks']);
		$this->setContentTitle(\Lang::get('task._name_plural'));

		$this->layout->content = \View::make('task.dashboard')
			->with('auxdata', $auxdata);
	}
}