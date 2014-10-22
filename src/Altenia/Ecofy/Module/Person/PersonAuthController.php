<?php namespace Altenia\Ecofy\Module\Person;

use Altenia\Ecofy\Service\ServiceRegistry;
use Altenia\Ecofy\Support\AuthzFacade;
use Altenia\Ecofy\Module\User\User;
use Altenia\Ecofy\Service\ValidationException;

use Altenia\Ecofy\Controller\BaseController;

/**
 * @Tutorial
 * Auth Controller for authetnication
 * Notice app/routes.php maps using Route::controller
 * The method is prefixed by the HTTP method name
 *
 * Taken from: http://net.tutsplus.com/tutorials/php/authentication-with-laravel-4/
 */
class PersonAuthController extends BaseController { 

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
        $this->layout->content = View::make('auth.signup2');
    }

    /**
     * Show Login form
     * Note: You must customize the default behavior of redirecting to /login
     * by modifying the file app/filters.php with 'auth' filter that returns
     * `/auth/signin` instead of `/login`
     */
    public function getSignin() {
        $name = trim(\Input::get('name'));
        $this->layout->content = \View::make('auth.personsignin')
            ->with('name', $name);
            //->withInput();
    }

    /**
     * Do Logout
     */
    public function getSignout() {
        AuthzFacade::logout();
        AuthzFacade::removeSession();
        return Redirect::to('auth/signin')
            ->with('message', 'Your have logged out!');
    }

    /**
     * Do Login
     */
    public function postSignin()
    {
        // passdata is either email or phone number
        $email = trim(Input::get('email'));
        $verifier = trim(Input::get('verifier'));
        $person_criteria = array('name_nl' => Input::get('name'));

        $persons = $this->getPersonService()->listPersons($person_criteria);

        $matchPerson = null;
        $matchField = 0;
        foreach($persons as $person) {
            if (!empty($person->email) && $person->email == $email)
                $matchField |= 1;

            if (!empty($person->mobile_number) && $person->mobile_number == $verifier)
                $matchField |= 2;
            if (!empty($person->telephone) && $person->telephone == $verifier)
                $matchField |= 4;
            if (!empty($person->postal_code) && $person->postal_code == $verifier)
                $matchField |= 8;
            
            if ($matchField > 2 && ($matchField & 1) > 0) {
                $matchPerson = $person;
                break;
            }
        }

        if ($matchPerson != null) {
            // If matcher person exists, verify if there is a user associated with it.
            // If it does not, create one and log in, if it does, retrieve a log in. 
            if ( empty($matchPerson->user_sid)) {
                // Create a low-profile(few permissions) user from the person data.
                $userData = array();
                $userData['id'] = $data['id'] = str_replace('@', '_', $email);
                $userData['name'] = $matchPerson->name;
                $userData['given_name'] = $matchPerson->given_name;
                $userData['family_name'] = $matchPerson->family_name;
                $userData['name_nl'] = $matchPerson->name_nl;
                $userData['phone'] = $matchPerson->telephone;
                $userData['email'] = $matchPerson->email;
                $userData['type'] = 'member';
                $userData['password'] = $verifier;

                //print_r($userData); 
                //die("-- CREATING A USER, AND LOGIN IN --");

                try {
                    $user = $this->getUserService()->createUser($userData);
                    $matchPerson->user_sid = $user->sid;
                    $this->getPersonService()->updatePersonModel($matchPerson);
                } catch (ValidationException $ve) {
                    return Redirect::to('personauth/signin')
                        ->withErrors($ve->getObject())
                        ->withInput();
                }
                AuthzFacade::login($user);
            } else {
                // Retrieve the user
                $user = $this->getUserService()->findUserByPK($matchPerson->user_sid);

                //print_r($user); 
                //die("-- USER FOUND, LOGIN IN --");

                AuthzFacade::login($user);
            }
            return Redirect::to('persons');
        } else {
            \Log::debug('Signin attempt failed.');
            //Session::flash('message',  );
            return Redirect::to('personauth/signin')
                ->withErrors( 'Your name/data combination was incorrect!')
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
                if  (!empty($data['email']) && strcasecmp($person->email, $data['email']) == 0 )
                    $match = $match | 1;
                if  (!empty($data['mobile_number']) && ($person->mobile_number == $data['mobile_number']) )
                    $match = $match | 2;
                if  (!empty($data['telephone']) && ($person->telephone == $data['telephone']) )
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
        } catch (ValidationException $ve) {
            return \Redirect::to('auth/signup')
                ->withErrors($ve->getObject())
                ->withInput(Input::except('password'));
        } /*catch (Exception $e) {
            return Redirect::to('auth/signup')
                ->withErrors($e->getMessage())
                ->withInput(Input::except('password'));
        }*/
    }


    /**
     * Do Logout
     */
    public function getNopermission() {
        $this->layout->content = View::make('auth.nopermission');
    }
}
