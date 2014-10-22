<?php namespace Altenia\Ecofy\Module\Organization;

use Altenia\Ecofy\Controller\GenericServiceApiController;

/**
 * Controller class that provides REST API to Organization resource
 *
 * @todo: Add following line in app/routes.php
 * Route::resource('organizations', 'OrganizationController');
 */
class OrganizationApiController extends GenericServiceApiController {

	public function __construct() {
		parent::__construct('svc:organization', 'Organization');
	}

}