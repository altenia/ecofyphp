<?php namespace Altenia\Ecofy\Dao;

use Altenia\Ecofy\Support\QueryBuilderEloquent;

/**
 * Helper class that provides HTML rendering functionalites.
 */
class BaseDaoEloquent extends BaseDao {

	public function __construct($modelFqn)
    {
    	parent::__construct($modelFqn);
    }

    public function buildQuery($criteria)
    {
    	$modelClassName = $this->modelClassName();
        if (empty($criteria)) $criteria = array();
        $queryBuilder = new QueryBuilderEloquent();
        $query = $modelClassName::query();
        
        $query = $queryBuilder->buildQuery($criteria, $query);
        return $query; 
    }

    /**
     * Queries the records.
     *
     * @param array $criteria     Parameters used for querying
     * @param int   $sortParams   Parameters used for sorting
     * @param int   $offset       The starting record
     * @param int   $limit        Maximum number of records to retrieve
     * @return Response
     */
    public function query($criteria, $sortParams = array(), $offset = 0, $limit=100)
    {
        $query = $this->buildQuery($criteria);
        // @todo - orderBy()->get()
        $records = $query->skip($offset)->take($limit)->get();

        return $records;
    }


    /**
     * Returns the count of records satisfying the critieria.
     *
     * @param array $queryParams  Parameters used for querying
     * @return int number of records that satisfied the criteria
     */
    public function count($criteria)
    {
        $query = $this->buildQuery($criteria);
        $count = $query->count();
        return $count;
    }

    /**
     * Pagination
     * @param int   $limit        Maximum number of records to retrieve
     */
    public function paginate($criteria, $sortParams = array(), $page_size)
    {
        $query = $this->buildQuery($criteria);
        $records = $query->paginate($page_size);
        return $records;
    }
    /**
     * Inserts record.
     * Mostly wrapper around insert with pre and post processing.
     *
     * @param array $record  Model tha has already validated
     * @return mixed  null if successful, validation object validation fails
     */
    public function insert($record)
    {
        $record->uuid = $this->genUuid();
        $dbtime_now = $this->toDbDateTime();
        $record->created_dt = $dbtime_now;
        $record->updated_dt = $dbtime_now;

        $this->beforeInsert($record);
        $record->save();

        return $record;
    }

    /**
     * Retrieves a single record.
     *
     * @param  int $pk  The primary key for the search
     * @return Transaction
     */
    public function find($criteria)
    {
    	$query = $this->buildQuery($criteria);
        $records = $query->take(2)->get();

        if ($records->count() > 1) {
        	throw new \Exception("More than one entry found");
        } else if ($records->count() !== 1) {
        	return null;
        }

        return $records->first();
    }

    /**
     * Retrieves a single record.
     *
     * @param  int $pk  The primary key for the search
     * @return AccessControl
     */
    public function findByPK($pk)
    {
    	$modelClassName = $this->modelClassName();
        $record = $modelClassName::find($pk);

        return $record;
    }

    /**
     * Update the specified resource.
     *
     * @param  int   $pk    The primary key of the record to update
     * @param  array $data  The data of the update
     * @return mixed Returns the newely updated record
     */
    public function update($record)
    {
        $record->updated_dt = $this->toDbDateTime();
        $record->update_counter++;

        $this->beforeUpdate($record);

        $record->save();
        return $record;
    }

    /**
     * Update the fields.
     *
     * @param  int   $pk    The primary key of the record to update
     * @param  array $data  Fields to update
     * @return mixed Returns the newely updated record
     */
    public function updateFields($pk, $data)
    {
        $record = $this->findByPK($pk);
        $record->fill($data);
        return $this->update($record);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $pk
     * @return Object the object that was deleted, null if not found
     */
    public function delete($pk)
    {
        $modelClassName = $this->modelClassName();

        $record = $modelClassName::find($pk);
        if (!empty($record)) {
            $record->delete();
            return $record;
        }
        return null;
    }


    /**
     * @param $date Either null or string in iso format
     */
    protected function toDbDateTime($time = null)
    {
        if (empty($time))
            return null;
        $format = 'Y-m-d H:i:s';
        $time = DateTime::createFromFormat($format, $time);
        $time_str = $time->format('Y-m-d H:i:s');

        return $time_str;
    }

    /**
     * Returns the DB date to ISO date time
     * @param $date Either null or string in iso format
     */
    protected function toIsoDateTime($time = null)
    {
        if (empty($time))
            return null;
        $format = 'Y-m-d H:i:s';
        $time = DateTime::createFromFormat($format, $time);
        $time_str = $time->format(DateTime::ISO8601);

        return $time_str;
    }
}
