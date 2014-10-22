<?php namespace Altenia\Ecofy\Module\User;

use Altenia\Ecofy\Controller\GenericServiceApiController;

/**
 * Controller class that provides REST API to User resource
 *
 * @todo: Add following line in app/routes.php
 * Route::resource('users', 'UserController');
 */
class UserApiController extends GenericServiceApiController {

	public function __construct() {
		parent::__construct('svc:user', 'User');
	}

}