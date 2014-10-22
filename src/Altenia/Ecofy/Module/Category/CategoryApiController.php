<?php namespace Altenia\Ecofy\Module\Category;

use Altenia\Ecofy\Controller\GenericServiceApiController;

/**
 * Controller class that provides REST API to Category resource
 *
 * @todo: Add following line in app/routes.php
 * Route::resource('categories', 'CategoryController');
 */
class CategoryApiController extends GenericServiceApiController {

	public function __construct() {
		parent::__construct('svc:category', 'Category', 'Categories');
	}

}