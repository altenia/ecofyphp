<?php namespace Altenia\Ecofy\Service;

/**
 * Base class for all services
 */
class BaseDataService extends BaseService {

	/** Main DataAccessObject **/
	protected $dao;


	/** Reference to the access control service **/
	private $acessControlService = null;

	public function __construct($dao, $id)
    {
    	parent::__construct($id);
    	$this->dao = $dao; 
    }

    public function getDao()
    {
    	return $this->dao;
    }

}