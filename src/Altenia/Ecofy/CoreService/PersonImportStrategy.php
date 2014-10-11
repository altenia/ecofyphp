<?php namespace Altenia\Ecofy\CoreService;

use \Altenia\Ecofy\Util\AddressUtil;

/**
 * Person import strategy
 */
class PersonImportStrategy  {

	/**
	 * Called before the main record is inserted.
	 * Sample use: populate referencing data prior insertion
	 */
	public function prepareInput(&$row, &$prev_row)
	{
		// Decompose address into state and zip
		if (array_key_exists('address', $row)) {
			$addressParts = AddressUtil::parse($row['address']);
			//print_r($addressParts);
			$row['address'] = $addressParts['address'];
			$row['province_cd'] = $addressParts['province_cd'];
			$row['postal_code'] = $addressParts['postal_code'];

			// Obtain the head of the family info
			// by getting the id of the first person of same address.
			$row['head_of_family_id'] = null;
			if ($prev_row != null) {
				if (!empty($row['address'])) { 
					$currFullAddress = AddressUtil::parse($row['address']);
					$prevFullAddress = AddressUtil::parse($prev_row['address']);

					if ($currFullAddress == $prevFullAddress) {
						if ( !empty($prev_row['head_of_family_id']) ) {
							$row['head_of_family_id'] = $prev_row['head_of_family_id'];
						} else {
							$row['head_of_family_id'] = $prev_row['id'];
						}
					}
				} 
			} 
		}

		// Parses the given and family name from name
		if (array_key_exists('name', $row)) {
			$givenName = null;
			$familyName = null;
			$token = explode(',', $row['name']);
			if (count($token) == 1) {
				$givenName = $token[0];
			} else {
				$familyName = trim($token[0]);
				$givenName = trim($token[1]);
			}

			if (!array_key_exists('given_name', $row)) {
				$row['given_name'] = $givenName;
			}
			if (!array_key_exists('family_name', $row)) {
				$row['family_name'] = $familyName;
			}
		}
	}

	/**
	 * Called right before inserting record
	 */
	public function beforeRecordInsert(&$row, $errors)
	{
		$row['status'] = 'imported';
	}

	/**
	 * Called after the main record was inserted.
	 * Sample use: Create a new related records which has FK reference to the newely inserted record
	 */
	public function afterRecordInsert($service, $record, &$row, $errors)
	{
		// Set the head_of_family sid
		if (!array_key_exists('head_of_family_id', $row) 
			|| empty($row['head_of_family_id'])
			|| $row['head_of_family_id'] == $row['id']) 
		{
			$record->head_of_family = $record->sid;
		} else {
			$criteria = array('id' => $row['head_of_family_id']);
			$headOfFamily = $service->findPerson($criteria);
			$record->head_of_family = $headOfFamily->sid;
		}
		$service->updatePersonModel($record);
	}

	/**
	 * Called after the main record was updated.
	 * Sample use: Create a new related records which has FK reference to the newely inserted record
	 */
	public function afterRecordUpdate($service, $record, &$row, $errors)
	{
		$this->afterRecordInsert($service, $record, $row, $errors);
	}
}
