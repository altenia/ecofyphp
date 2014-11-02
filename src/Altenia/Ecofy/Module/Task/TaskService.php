<?php namespace Altenia\Ecofy\Module\Task;

use Altenia\Ecofy\Service\BaseDataService;
use Altenia\Ecofy\Service\ValidationException;

/**
 * Service class that provides business logic for task
 */
class TaskService extends BaseDataService {

    /**
     * Constructor
     */
    public function __construct($dao, $id = 'task')
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
	public function listTasks($criteria, $sortParams = array(), $offset = 0, $limit=100)
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
	public function paginateTasks($queryParams, $page_size = 20)
	{
	    // @TODO: pending
		$query = \Task::query();
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
	public function countTasks($criteria)
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
	public function createTask($data)
	{
		$validator = Task::validator($data);
        if ($validator->passes()) {
            $record = new Task();
            $record->fill($data);

            return $this->dao->insert($record);
        } else {
            throw new ValidationException($validator);
        }
	}

	/**
	 * Retrieves a single record.
	 *
	 * @param  array $criteria  The criteria to retrieve a single record
	 * @return Task
	 */
	public function findTask($criteria)
	{
        return $this->dao->find($criteria);
	}

	/**
	 * Retrieves a single record.
	 *
	 * @param  int $pk  The primary key for the search
	 * @return Task
	 */
	public function findTaskByPK($pk)
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
	public function updateTask($pk, $data)
	{
		$validator = Task::validator($data, false);
        if ($validator->passes()) {
            return $this->dao->updateFields( $pk, $data );
        } else {
            throw new ValidationException($validator);
        }
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  object $model  A valid person model
	 * @return mixed null if successful, validation if validation error
	 */
	public function updateTaskModel($model)
	{
        return $this->dao->update( $model );
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $pk
	 * @return Object the object that was deleted, null if not found
	 */
	public function destroyTask($pk)
	{
		return $this->dao->delete($pk);
	}

}
