<?php namespace Altenia\Ecofy\Service;

/**
 * Service class that provides business logic for User
 */
class ValidationException extends ServiceException {

	public function __construct($validator = null) 
	{
		// Should the first param be: (string)$validator->messages()->getMessages()
		parent::__construct((string)$validator->messages(), ServiceException::CODE_VALIDATION, null, $validator);
    }

}
