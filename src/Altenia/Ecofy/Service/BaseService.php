<?php namespace Altenia\Ecofy\Service;

/**
 * Base class for all services
 */
class BaseService {

	/** Service id **/
	private $id;

	/**
	 * The service that contains this service.
	 * E.g. In blog-comment relation, the Blog service will be container, and comment will be contained
	 */
	private $containerService = null;

	/**
	 * The services that are contained in this service.
	 * E.g. If this service is blog then, comment and attachment services will be contained services.
	 */
	private $containedServices = array();

	/** Reference to the access control service **/
	private $acessControlService = null;

	public function __construct($id)
    {
        $this->id = $id;
    }

	public function getId()
	{
		return $this->id;
	}


	/**
	 * 
	 * @param {string | Object} $sevice
	 */
	public function setContainerService($service, $registerAsContained = true)
	{
		if (is_object($service)) {
			$this->containerService = $service;
		} else if (is_string($service)) {
			// It's a service name, resolve and assign
			$this->containerService = \App::make($service);
		}
		if ($registerAsContained === true) {
			// Also register itself as contained service in the container
			$this->containerService->addContainedService($this);
		}
	}

	public function getContainerService()
	{
		return $this->containerService;
	}

	/**
	 * Returns the top-most (root) container service
	 */
	public function getRootContainerService()
	{
		$service = $this;
		while($service !== null) {
			if ($service->containerService === null) {
				return $service;
			}
			$service = $service->containerService;
		}
	}

	/**
	 * Returns the the path fo the servers from the root service
	 */
	public function getServicePath()
	{
		$retval = array();
		$service = $this;
		while($service !== null) {
			$retval[] = $service->getId();
			if ($service->containerService === null) {
				return array_reverse($retval);
			}
			$service = $service->containerService;
		}
	}

	/**
	 * 
	 * @param {string | Object} $sevice
	 */
	public function addContainedService($service)
	{
		$service_ref = null;
		if (is_object($service)) {
			$service_ref = $service;
		} else if (is_string($service)) {
			// It's a service name, resolve and assign
			$service_ref = \App::make($service);
		}
		if (in_array($service, $this->containedServices)) {
			$this->containedServices[] = $service_ref;
		}
	}

	/**
	 * Returns a newly generated unique ID
	 * @return string uuid
	 */
	protected function generateUuid()
	{
		return BaseService::uuidV4();
	}

	public static function uuidV4() {
	    return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',

	      // 32 bits for "time_low"
	      mt_rand(0, 0xffff), mt_rand(0, 0xffff),

	      // 16 bits for "time_mid"
	      mt_rand(0, 0xffff),

	      // 16 bits for "time_hi_and_version",
	      // four most significant bits holds version number 4
	      mt_rand(0, 0x0fff) | 0x4000,

	      // 16 bits, 8 bits for "clk_seq_hi_res",
	      // 8 bits for "clk_seq_low",
	      // two most significant bits holds zero and one for variant DCE1.1
	      mt_rand(0, 0x3fff) | 0x8000,

	      // 48 bits for "node"
	      mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
	    );
	}

	public function getAccessControlService()
	{
		if ($this->acessControlService == null) {
			// @todo - externalize the access_control service name
			$this->acessControlService = \App::make('svc:access_control');
		}
		return $this->acessControlService;
		
	}

}