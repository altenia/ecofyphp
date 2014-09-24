<?php namespace Altenia\Ecofy\Support;

use Illuminate\Hashing\HasherInterface;
use Illuminate\Auth\UserProviderInterface;
use Illuminate\Auth\UserInterface;

/**
 * For Laravel Authentication
 */
class UserProvider implements UserProviderInterface {

	private $userService;

	/**
	 * The hasher implementation.
	 *
	 * @var \Illuminate\Hashing\HasherInterface
	 */
	protected $hasher;

	/**
	 * Create a new database user provider.
	 *
	 * @param  \Illuminate\Hashing\HasherInterface  $hasher
	 * @param  string  $model
	 * @return void
	 */
	public function __construct(HasherInterface $hasher)
	{
		$this->hasher = $hasher;
	}

	/**
	 * Retrieve a user by their unique identifier.
	 *
	 * @param  mixed  $identifier
	 * @return \Illuminate\Auth\UserInterface|null
	 */
	public function retrieveById($identifier)
	{
		return $this->getUserService()->findUserByPK($identifier);
	}

	/**
	 * Retrieve a user by their unique identifier and "remember me" token.
	 *
	 * @param  mixed  $identifier
	 * @param  string  $token
	 * @return \Illuminate\Auth\UserInterface|null
	 */
	public function retrieveByToken($identifier, $token)
	{
		$criteria = array($model->getKeyName() => $identifier, $user->getRememberTokenName() => $token);
		return $this->getUserService()->findUser($criteria);
	}

	/**
	 * Update the "remember me" token for the given user in storage.
	 *
	 * @param  \Illuminate\Auth\UserInterface  $user
	 * @param  string  $token
	 * @return void
	 */
	public function updateRememberToken(UserInterface $user, $token)
	{
		$user->setAttribute($user->getRememberTokenName(), $token);

		$this->getUserService()->updateUserModel($user);
	}

	/**
	 * Retrieve a user by the given credentials.
	 *
	 * @param  array  $credentials
	 * @return \Illuminate\Auth\UserInterface|null
	 */
	public function retrieveByCredentials(array $credentials)
	{
		$userCriteria = array();

		// Ignore password from credential to retrieve the user
		foreach ($credentials as $key => $value)
		{
			if ( ! str_contains($key, 'password') && ! str_contains($key, 'login_id') ) 
				$userCriteria[$key] = $value;
		}

		// assign id or email accordingly
		if (isset($credentials['login_id'])) {
			$loginId = $credentials['login_id'];
			if ( strrpos($loginId, '@') === false) {
				$userCriteria['id'] = $loginId;
			} else {
				$userCriteria['email'] = $loginId;
			}
		}

		$user = $this->getUserService()->findUser($userCriteria);

		return $user;
	}

	/**
	 * Validate a user against the given credentials.
	 *
	 * @param  \Illuminate\Auth\UserInterface  $user
	 * @param  array  $credentials
	 * @return bool
	 */
	public function validateCredentials(UserInterface $user, array $credentials)
	{
		$plain = $credentials['password'];

		$valid = $this->hasher->check($plain, $user->getAuthPassword());

		return $valid;
	}

	/**
	 * Returns the underlying User service
	 */
	public function getUserService()
	{
		if (empty($this->userService)) {
			$this->userService = \App::make('svc:user');
		}
		return $this->userService;
	}

}
