<?php namespace Altenia\Ecofy\Module\Role;

use Altenia\Ecofy\Controller\GenericServiceApiController;

/**
 * Controller class that provides REST API to Role resource
 *
 * @todo: Add following line in app/routes.php
 * Route::resource('roles', 'RoleController');
 */
class RoleApiController extends GenericServiceApiController {

	public function __construct() {
		parent::__construct('svc:role', 'Role');
	}

}