<?php namespace Altenia\Ecofy\Module\CodeRef;

use Altenia\Ecofy\Controller\GenericServiceApiController;

/**
 * Controller class that provides REST API to CodeRef resource
 *
 * @todo: Add following line in app/routes.php
 * Route::resource('code_refs', 'CodeRefController');
 */
class CodeRefApiController extends GenericServiceApiController {

	public function __construct() {
		parent::__construct('svc:code_ref', 'CodeRef');
	}

}