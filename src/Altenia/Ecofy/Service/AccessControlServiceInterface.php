<?php namespace Altenia\Ecofy\Service;

/**
 * Service class that provides business logic for access_control
 */
interface AccessControlServiceInterface {

	/**
	 * Returns list of the records.
	 *
	 * @param array $criteria     Parameters used for querying
	 * @param int   $sortParams   Parameters used for sorting
	 * @param int   $offset       The starting record
	 * @param int   $limit        Maximum number of records to retrieve
	 * @return Response
	 */
	public function listAccessControls($criteria, $sortParams = array(), $offset = 0, $limit=100);

	/**
	 * Returns paginated list of the records.
	 *
	 * @param array $queryParams  Parameters used for querying
	 * @param int   $page_size    The max number of entries shown per page
	 * @return Response
	 */
	public function paginateAccessControls($queryParams, $page_size = 20);

    /**
	 * Returns the count of records satisfying the critieria.
	 *
	 * @param array $criteria  Parameters used for querying
	 * @return int number of records that satisfied the criteria
	 */
	public function countAccessControls($criteria);

	/**
	 * Creates a new records.
	 * Mostly wrapper around insert with pre and post processing.
	 *
	 * @param array $data  Parameters used for creating a new record
	 * @return mixed  null if successful, validation object validation fails
	 */
	public function createAccessControl($data);

	/**
	 * Retrieves a single record.
	 *
	 * @param  int $criteria  The primary key for the search
	 * @return AccessControl
	 */
	public function findAccessControl($criteria);

	/**
	 * Retrieves a single record.
	 *
	 * @param  int $pk  The primary key for the search
	 * @return AccessControl
	 */
	public function findAccessControlByPK($pk);

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int   $pk    The primary key of the record to update
	 * @param  array $data  The data of the update
	 * @return mixed null if successful, validation if validation error
	 */
	public function updateAccessControl($pk, $data);

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $pk
	 * @return Object the object that was deleted, null if not found
	 */
	public function destroyAccessControl($pk);

	/**
	 * Retrieves a access control of a user.
	 *
	 * @param  User $user  The primary key for the search
	 * @return AccessControl
	 */
	public function findAccessControlByUser($user);
}
