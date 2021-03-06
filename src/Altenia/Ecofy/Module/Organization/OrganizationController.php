<?php namespace Altenia\Ecofy\Module\Organization;
/**
 * Models from schema: AldosEngine version 0.1
 * Code generated by TransformTask
 *
 */

use Altenia\Ecofy\Controller\GenericServiceController;
use Altenia\Ecofy\Service\ServiceRegistry;

/**
 * Controller class that provides REST API to Organization resource
 */
class OrganizationController extends GenericServiceController {

	public function __construct() {
		parent::__construct('layouts.workspace', 'svc:organization', 'Organization');
	}

	public function editAuxData(&$record) {
		$auxdata = array();

		$qparams = array('subject_type' => 'organization');
		$roles = $this->getRoleService()->listRoles($qparams, array(), 0, 50);
		$opt_roles = array('' => '-');
		foreach($roles->toArray() as $role) {
			$opt_roles[$role['sid']] = $role['name'];
		}
		$auxdata['opt_roles'] = $opt_roles;

		return $auxdata;
	}

	private function getRoleService()
	{
		return ServiceRegistry::instance()->getServiceObject('role');
	}
	
}