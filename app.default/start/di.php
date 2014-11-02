<?php

use Illuminate\Auth\Guard;

/*
|--------------------------------------------------------------------------
| Register objects to the Dependency Injection
|--------------------------------------------------------------------------
|
|
*/
use \Altenia\Ecofy\Service\ServiceRegistry;
use \Altenia\Ecofy\Support\SiteContext;
use \Altenia\Ecofy\Module\Security\PredefinedAcl;

\Altenia\Ecofy\Dao\MongoDb::$db_name = 'ecofy';


App::singleton('svc:category', function()
{
    $dao = new \Altenia\Ecofy\Module\Category\CategoryDaoEloquent();
    return new \Altenia\Ecofy\Module\Category\CategoryService($dao);
});

App::singleton('svc:code_ref', function()
{
    $dao = new \Altenia\Ecofy\Module\CodeRef\CodeRefDaoEloquent();
    return new \Altenia\Ecofy\Module\CodeRef\CodeRefService($dao);
});

App::singleton('svc:user', function()
{
	$dao = new \Altenia\Ecofy\Module\User\UserDaoEloquent();
    return new \Altenia\Ecofy\Module\User\UserService($dao);
});

App::singleton('svc:role', function()
{
	$dao = new \Altenia\Ecofy\Module\Role\RoleDaoEloquent();
    return new \Altenia\Ecofy\Module\Role\RoleService($dao);
});

App::singleton('svc:organization', function()
{
	$dao = new \Altenia\Ecofy\Module\Organization\OrganizationDaoEloquent();
    return new \Altenia\Ecofy\Module\Organization\OrganizationService($dao);
});

App::singleton('svc:person', function()
{
    $dao = new \Altenia\Ecofy\Module\Person\PersonDaoEloquent();
    return new \Altenia\Ecofy\Module\Person\PersonService($dao);
});


// addServiceEntry($id, $title, $url, $icon, $permission)
ServiceRegistry::instance()->addEntry('category', Lang::get('category._name_plural'), 
    \URL::to('categories'), 'fa-sitemap');

ServiceRegistry::instance()->addEntry('code_ref', Lang::get('code_ref._name_plural'), 
    \URL::to('code_refs'), 'glyphicon-list');

ServiceRegistry::instance()->addEntry('user', Lang::get('user._name_plural'), 
	\URL::to('users'), 'glyphicon-user');

ServiceRegistry::instance()->addEntry('role', Lang::get('role._name_plural'), 
	\URL::to('roles'), 'fa-key');

ServiceRegistry::instance()->addEntry('organization', Lang::get('organization._name_plural'), 
	\URL::to('organizations'), 'fa-institution');

ServiceRegistry::instance()->addEntry('person', Lang::get('person._name_plural'), 
    \URL::to('persons'), 'fa-user');

ServiceRegistry::instance()->addEntry('menu', 'Menu', null, null, function()
{
    return new \Altenia\Ecofy\CoreService\MenuService();
});


/**
 * Will make Illuminate\Auth\AuthManager to return the Guard with my own provider
 * Which uses the userService
 * config/auth.php must be modify to include
 * 'driver' => 'ecofy_auth_driver',
 *
 * @see-also Illuminate\Support\Driver:createDriver
 * @see http://toddish.co.uk/blog/creating-a-custom-laravel-4-auth-driver/
 */
Auth::extend('ecofy_auth_driver', function()
{
    return new Guard(
        new \Altenia\Ecofy\Support\UserProvider( App::make('hash') ),
        App::make('session.store')
    );
});

// 63 = everythin up to admin

PredefinedAcl::addAcl('admin', '{
                "svc:user": {"@permissions": 63},
                "svc:organization": {"@permissions": 63},
                "svc:role": {"@permissions": 63},
                "svc:person": {"@permissions": 63},
                "svc:mailer": {"@permissions": 63}
            }', 63);

PredefinedAcl::addAcl('staff', '{
                "svc:user": {"@permissions": 15},
                "svc:organization": {"@permissions": 15},
                "svc:person": {"@permissions": 63}
            }', 5);

PredefinedAcl::addAcl('member', '{
                "svc:user": {"@permissions": 7},
                "svc:person": {"@permissions": 7}
            }', 5);

PredefinedAcl::addAcl('default', '{
                "svc:person": {"@permissions": 3}
            }', 1);
