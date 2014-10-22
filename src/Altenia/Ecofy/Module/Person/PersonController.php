<?php namespace Altenia\Ecofy\Module\Person;

/**
 * Models from schema: AldosEngine version 0.1
 * Code generated by TransformTask
 *
 */

use Altenia\Ecofy\Service\ServiceRegistry;
use Altenia\Ecofy\Controller\GenericServiceController;
use Altenia\Ecofy\Support\ResponseFactoryCsv;

/**
 * Controller class that provides REST API to Person resource
 */
class PersonController extends GenericServiceController {

	public static $statuses = ['imported' => 'imported'
			, 'registered' => 'registered', 'verified' => 'verified'
			, 'departed' => 'departed'];

	public function __construct()
	{
		parent::__construct('layouts.workspace', 'svc:person', 'Person');
		$colsToExport = ['status', 'id', 'isHeadOfFamily()', 'name_nl', 'getFullName2()', 'alternate_name'
			, 'affiliation', 'getFullAddress()', 'mobile_number', 'telephone', 'email'];
		$this->registerResponseFactory('index/csv'
				, new ResponseFactoryCsv('person', $colsToExport)
			);
	}

	/**
	 * The service method name to list on index
	 */
	protected function listMethod() {
		return 'list' . $this->modelNamePlural . 'OrderByFamily';
	}

	/**
	 * Sort param
	 */
	protected function sortParams() {
		return array('hof_person.name_nl' => 'asc'
			,'persons.id' => 'asc');
	}


	public function indexAuxData() {
		$auxdata = array();

		$auxdata['status'] = [ '' => 'all', '~departed' => 'all but departed', 'imported' => 'imported'
			, 'registered' => 'registered', 'verified' => 'verified'
			, 'departed' => 'departed'];
		return $auxdata;
	}

	public function createAuxData() {
		$auxdata = array();

		$auxdata['status'] = ['imported' => 'imported'
			, 'registered' => 'registered', 'verified' => 'verified'
			, 'departed' => 'departed'];
		$auxdata['affiliations'] = [];

		// Load hof is provided
		$hofSid = \Input::get('hof');
		if ( !empty($hofSid)) {
			$headOfFamily = $this->service->findPerson(array('sid' => $hofSid));
			$auxdata['hof'] = $headOfFamily;
		}

		// Get the last id
		$lastIdUser = $this->service->listPersons(array(), array('id' => 'desc'), 0, 1);
		$lastId = $lastIdUser[0]->id;
		$lastId++;
		$auxdata['nextId'] = $lastId;

		return $auxdata;
	}

	public function editAuxData(&$record) {
		$auxdata = $this->createAuxData();

		if ( !empty($record->head_of_family)) {
			$headOfFamily = $this->service->findPerson(array('sid' => $record->head_of_family));
			$record->head_of_family_name = $headOfFamily->getFullName();
			$familyMembers = $this->service->listPersons(array('head_of_family' => $record->head_of_family), array(), 0, 20);
			$record->familyMembers = $familyMembers;
		}

		return $auxdata;
	}

	protected function showAuxData(&$record) {

		if ( !empty($record->head_of_family)) {
			$headOfFamily = $this->service->findPerson(array('sid' => $record->head_of_family));
			$record->head_of_family_name = $headOfFamily->getFullName();
			$familyMembers = $this->service->listPersons(array('head_of_family' => $record->head_of_family), array(), 0, 20);
			$record->familyMembers = $familyMembers;
		}

		// get the user associated with the person record
		$userSvc = ServiceRegistry::instance()->getServiceObject('user');
		if ($userSvc !== null && !empty($record->updated_by)) {
			$updatedByUser = $userSvc->findUser(array('sid' => $record->updated_by));
			if ($updatedByUser !== null) {
				$record->updated_by_name = $updatedByUser->getFullName();
			}
		}
		
		return null;
	}

	/**
	 * Method that is called after record is created
	 * @param object $record the record that was created
	 */
	protected function afterRecordCreate(&$record) {
		$test = \Input::get('self_hof');
		if ( empty($record->head_of_family) && \Input::get('self_hof')) {
			$data = array ('head_of_family' => $record->sid);
			$this->service->updatePerson($record->sid, $data);
		}
	}

	/**
	 * Method that is called before creating
	 * @param array $data  the array fromwhich the record will be created
	 */
	protected function beforeRecordUpdate(&$data) {
		$email = trim($data['email']);
		if (empty($email)) {
			unset($data['email']);
		}
	}

	
}