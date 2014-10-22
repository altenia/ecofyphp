<?php namespace Altenia\Ecofy\Module\Security;

use Altenia\Ecofy\Service\ServiceRegistry;
use Altenia\Ecofy\Support\AuthzFacade;
use Altenia\Ecofy\Support\SiteContext;

use Altenia\Ecofy\Controller\BaseController;

/**
 * @Tutorial
 * Auth Controller for authetnication
 * Notice app/routes.php maps using Route::controller
 * The method is prefixed by the HTTP method name
 *
 * Taken from: http://net.tutsplus.com/tutorials/php/authentication-with-laravel-4/
 */
class AuthController extends BaseController { 

    // The service object
    protected $userService;

    /**
     * If you look at the BaseController, you will notice that the 
     * setupLayout() method will 
     */
    protected $layout = 'layouts.site';

    /**
     * @Tutorial
     * Filter for guaring agains CSFR, and for protecting private pages. 
     */
    public function __construct() {
       $this->beforeFilter('csrf', array('on'=>'post'));
       $this->beforeFilter('auth', array('only'=>array('getDashboard')));
       //$this->authService = App::make('svc:auth_service');
    }

    public function getUserService()
    {
        if ($this->userService == null) {
            $svcEntry = ServiceRegistry::instance()->findById('user');
            $this->userService = $svcEntry != null  ? $svcEntry->reference : null;
        }
        return $this->userService;
    }

    public function getPersonService()
    {
        $svcEntry = ServiceRegistry::instance()->findById('person');
        return $svcEntry != null  ? $svcEntry->reference : null;
    }

    /**
     * Show Login form
     * `/auth/signup` instead of `/login`
     */
    public function getSignup() {
        $this->layout->content = \View::make('auth.signup2');
    }

    /**
     * Show Login form
     * Note: You must customize the default behavior of redirecting to /login
     * by modifying the file app/filters.php with 'auth' filter that returns
     * `/auth/signin` instead of `/login`
     */
    public function getSignin() {
        $this->layout->content = \View::make('auth.signin');
    }

    /**
     * Do Logout
     */
    public function getSignout() {
        AuthzFacade::logout();
        //AuthzFacade::removeSession();
        return \Redirect::to('auth/signin')
            ->with('message', 'Your have logged out!');
    }

    /**
     * Do Login
     */
    public function postSignin()
    {
        //$password = \Hash::make( Input::get('password') );
        $password = \Input::get('password');
        $attempt_input = array(
            'login_id' => \Input::get('login_id'), 
            'password' => $password);

        if (AuthzFacade::attempt($attempt_input)) {
            //return Redirect::to('auth/dashboard')->with('message', 'You are now logged in!');
            return \Redirect::to(SiteContext::instance()->main_page[1]);
        } else {
            \Log::debug('Signin attempt failed.');
            \Session::flash('message', 'Your username/password combination was incorrect!' );
            return \Redirect::to('auth/signin')
              ->withInput();
        }
    }

    /**
     * Do Sign up
     */
    public function postSignup() {
        $data = \Input::all();

        try {
            $data['org_sid'] = 0;

            $personService = $this->getPersonService();

            // Person already exists
            if ($personService != null && $data['person_sid'] > 0) {
                // Check that either phone number or email matches
                $person = $personService->findPersonByPK($data['person_sid']);
                $match = 0;
                //print ('"' . $data['email'] . '" -- "' . $person->email . '"');
                if  (!empty($data['email']) &&  strcasecmp($person->email, $data['email']) == 0 )
                    $match = $match | 1;
                if  (!empty($data['telephone']) &&  strcasecmp($person->telephone, $data['telephone']) == 0 )
                    $match = $match | 2;
                if  (!empty($data['mobile_number']) &&  strcasecmp($person->mobile_number, $data['mobile_number']) == 0 )
                    $match = $match | 4;
                
                if ($match > 0) {
                    $user = $this->getUserService()->createUser($data);
                    $person->user_sid = $user->sid;
                    $personService->updatePersonModel($person);
                } else {
                    return \Redirect::to('auth/signup')
                        ->withErrors('email nor phone numbers matched')
                        ->withInput(Input::except('password'));
                }
            } else {
                $user = $this->getUserService()->createUser($data);
            }

            \Session::flash('message', 'Successfully created!');
            return \Redirect::to('users');
        } catch (Service\ValidationException $ve) {
            return \Redirect::to('auth/signup')
                ->withErrors($ve->getObject())
                ->withInput(\Input::except('password'));
        } /*catch (Exception $e) {
            return Redirect::to('auth/signup')
                ->withErrors($e->getMessage())
                ->withInput(Input::except('password'));
        }*/
    }

    /**
     * Some protected content
     */
    public function getDashboard() {
        return \Redirect::to('dashboard');
    }


    /**
     * Do Logout
     */
    public function getNopermission() {
        $this->layout->content = \View::make('auth.nopermission');
    }
}
