<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', 'SiteController@showHome');

Route::group(array('before' => 'authz'), function()
//Route::group(array(), function()
{
	Route::resource('api/categories', '\Altenia\Ecofy\Module\Category\CategoryApiController');
	Route::resource('categories', '\Altenia\Ecofy\Module\Category\CategoryController');

	Route::resource('api/code_refs', '\Altenia\Ecofy\Module\CodeRef\CodeRefApiController');
	Route::resource('code_refs', '\Altenia\Ecofy\Module\CodeRef\CodeRefController');

	Route::resource('api/users', '\Altenia\Ecofy\Module\User\UserApiController');
	Route::resource('users', '\Altenia\Ecofy\Module\User\UserController');
	Route::get('user/changepwd', '\Altenia\Ecofy\Module\User\UserController@getPasswordChangeForm');
	Route::put('user/changepwd', '\Altenia\Ecofy\Module\User\UserController@handlePasswordChangeForm');

	Route::resource('api/roles', '\Altenia\Ecofy\Module\Role\RoleApiController');
	Route::resource('roles', '\Altenia\Ecofy\Module\Role\RoleController');

	Route::resource('api/organizations', '\Altenia\Ecofy\Module\Organization\OrganizationApiController');
	Route::resource('organizations', '\Altenia\Ecofy\Module\Organization\OrganizationController');

	Route::resource('api/persons', '\Altenia\Ecofy\Module\Person\PersonApiController');
	Route::resource('persons', '\Altenia\Ecofy\Module\Person\PersonController');

	Route::controller('import', '\Altenia\Ecofy\Module\Tool\ImportController');
	Route::controller('mailer', '\Altenia\Ecofy\Module\Tool\MailerController');
	
});

// With this routing, the controller contains methods where the action
// name is prefixed by HTTP method, eg. getXx
Route::controller('auth', '\Altenia\Ecofy\Module\Security\AuthController');
Route::controller('personauth', '\Altenia\Ecofy\Module\Person\PersonAuthController');
