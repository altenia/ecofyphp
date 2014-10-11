<?php namespace Altenia\Ecofy\Service;

/**
 * Service class that provides business logic for User
 */
class ValidationException extends ServiceException {

	/**
	 * $object {MessageProviderInterface | array} object of MessageProviderInterface such as validator or an array of messages 
	 */
	public function __construct($object = null) 
	{
		// @todo - change argument from $validator to (array)$validation messages
		// Should the first param be: (string)$validator->messages()->getMessages()
		parent::__construct('ValidationException', ServiceException::CODE_VALIDATION, null, $object);
    }

}
