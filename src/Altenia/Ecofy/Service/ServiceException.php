<?php namespace Altenia\Ecofy\Service;


/**
 * Service class that provides business logic for User
 */
class ServiceException extends \Exception {

	const CODE_VALIDATION = 10;
	const CODE_DATA_ACCESS = 20;
	const CODE_DATA_STATE = 30;

	// Object that 
	private $object = null;

	public function __construct($message = null, $code = 0, Exception $previous = null, 
		$object = null) 
	{
		parent::__construct($message, $code, $previous);
        $this->object = $object;
    }

    public function getObject()
    {
    	return $this->object;
    }
}