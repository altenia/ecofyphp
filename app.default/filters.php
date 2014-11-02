<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

use Altenia\Ecofy\Support\AuthzFacade;

App::before(function($request)
{
	$siteContext = \Altenia\Ecofy\Support\SiteContext::instance();
	View::share('siteContext', $siteContext);

});


App::after(function($request, $response)
{
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function()
{
	if (Auth::guest())
	{
		if (Request::ajax())
		{
			return Response::make('Unauthorized', 401);
		}
		else
		{
			return Redirect::guest('login');
		}
	}
});


Route::filter('auth.basic', function()
{
	return Auth::basic();
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::to('/');
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	if (Session::token() != Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});

/**
 * Filter for authentication and access control
 */
Route::filter('authz', function()
{
	//if (Auth::guest()) return Redirect::guest('auth/signin');

	list($resource, $permission) = AuthzFacade::deduceResourceAndPermission();

	if (!AuthzFacade::check($permission, $resource)) {
		//die('No permission to ' . $resource);
		Session::flash('message', 'No permission to the resource "' . $resource. '"') ;
		return Redirect::to('auth/nopermission');
	}

});

/**
 * View composer for layout.workspace to bind side menu
 */
View::composer('layouts.workspace', function($view){

	$user = \Auth::user();
//print_r($user);
	$ac = AuthzFacade::getAccessControl(\Auth::user());
//print_r($ac->policy);
	View::share('accessControl', $ac);	

    $menuService = \Altenia\Ecofy\Service\ServiceRegistry::instance()->findById('menu');
    
    $menus = $menuService->reference->getMenu();

    View::share('menus', $menus);
});