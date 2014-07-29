<?php namespace Altenia\Ecofy\CoreService;
/**
 * Mongo Service from schema: docuflow version 0.1
 * Code generated by TransformTask
 *
 */

/**
 * Service class that provides business logic for role
 */
class RoleService extends BaseService {

    /**
     * Constructor
     */
    public function __construct($dao, $id = 'role')
    {
        parent::__construct($dao, $id);
    }
    
	/**
	 * Returns list of the records.
	 *
	 * @param array $criteria     Parameters used for querying
	 * @param int   $offset       The starting record
	 * @param int   $limit        Maximum number of records to retrieve
	 * @return Response
	 */
	public function listRoles($criteria, $sortParams = array(), $offset = 0, $limit=100)
	{
		return $this->dao->query($criteria, $sortParams, $offset, $limit);
	}

	/**
	 * Returns paginated list of the records.
	 *
	 * @param array $queryParams  Parameters used for querying
	 * @param int   $page_size    The max number of entries shown per page
	 * @return Response
	 */
	public function paginateRoles($queryParams, $page_size = 20)
	{
	    // @TODO: pending
		$query = \Role::query();
		$query = $this->parseQueryParams($query, $queryParams);
        $records = $query->paginate($page_size);
		return $records;
	}

    /**
	 * Returns the count of records satisfying the critieria.
	 *
	 * @param array $criteria  Parameters used for querying
	 * @return int number of records that satisfied the criteria
	 */
	public function countRoles($criteria)
	{
		return $this->dao->count($criteria);
	}

	/**
	 * Creates a new records.
	 * Mostly wrapper around insert with pre and post processing.
	 *
	 * @param array $data  Parameters used for creating a new record
	 * @return mixed  null if successful, validation object validation fails
	 */
	public function createRole($data)
	{

		$validator = \Role::validator($data);
        if ($validator->passes()) {
            $record = new \Role();
            $record->fill($data);

            /*
             * @todo: assign default values as needed
             */
            $now = new \DateTime;
            $now_str = $now->format('Y-m-d H:i:s');
            $record->uuid = uniqid();
            $record->created_dt = $now_str;
            $record->updated_dt = $now_str;

            $arrModel = $record->toArray();
            $arrModel['_id'] = new \MongoId();
            $record->sid = (string)$arrModel['_id'];

            return $dao->insert($record);
        } else {
            throw new ValidationException($validator);
        }
	}

	/**
	 * Retrieves a single record.
	 *
	 * @param  array $criteria  The criteria to retrieve a single record
	 * @return Role
	 */
	public function findRole($criteria)
	{
        return $dao->find($criteria);
	}

	/**
	 * Retrieves a single record.
	 *
	 * @param  int $pk  The primary key for the search
	 * @return Role
	 */
	public function findRoleByPK($pk)
	{
		return $this->dao->findByPK($pk);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int   $pk    The primary key of the record to update
	 * @param  array $data  The data of the update
	 * @return mixed null if successful, validation if validation error
	 */
	public function updateRole($pk, $data)
	{
		$validator = \Role::validator($data);
        if ($validator->passes()) {
            $record = $this->findRoleByPK($pk);
            $record->fill($data);

            $now = new \DateTime;
            $now_str = $now->format('Y-m-d H:i:s');
            $record->updated_dt = $now_str;

            $arrModel = $record->toArray();
            $criteria = array( '_id' => new \MongoId($pk) );
            
            return $this->dao->update( $pk, $data );
        } else {
            throw new ValidationException($validator);
        }
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $pk
	 * @return Object the object that was deleted, null if not found
	 */
	public function destroyRole($pk)
	{
		return $this->dao->delete($pk);
	}

	/**
	 * Returns the Laravel model object
	 */
    private function toModel($doc)
    {
        $model = new \Role();
        $model->sid = (string)$doc['_id'];
        $model->fill($doc);
        return $model;
    }
}
