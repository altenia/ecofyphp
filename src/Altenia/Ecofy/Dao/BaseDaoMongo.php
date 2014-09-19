<?php namespace Altenia\Ecofy\Dao;

use Altenia\Ecofy\Support\QueryBuilderMongo;
use Illuminate\Support\Str;

/**
 * Base class for all services
 */
class BaseDaoMongo extends BaseDao {

    protected $db;
    protected $db_collection;

    /**
     * Constructor.
     * Selects the database collection with the name provided.
     */
	public function __construct($modelFqn, $collectionName = null)
    {
        parent::__construct($modelFqn);
        if ($collectionName === null)
            $collectionName  = Str::snake($modelFqn);
        $this->db = new MongoDb();
        $this->db_collection = $this->db->selectCollection($collectionName);
    }

	public function buildQuery($criteria)
	{
		if (empty($criteria)) $criteria = array();
		$queryBuilder = new QueryBuilderMongo();
        $query = array();
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
        $cursor = $this->db_collection->find( $query )
            ->skip($offset)->limit($limit);

        $records = array();
        while ($cursor->hasNext())
        {
            $doc = $cursor->getNext();
            $records[] = $this->toModel($doc);
        }
        $result = new \Illuminate\Support\Collection($records);
        
        return $result;
    }

    /**
     * Returns the count of records satisfying the critieria.
     *
     * @param array $criteria  Parameters used for querying
     * @return int number of records that satisfied the criteria
     */
    public function count($criteria)
    {
        $query = $this->buildQuery($criteria);
        $count = $this->db_collection->find( $criteria )->count();
        return $count;
    }

    /**
     * Inserts a new record.
     * Mostly wrapper around insert with pre and post processing.
     *
     * @param array $data  Parameters used for creating a new record
     * @return mixed  null if successful, validation object validation fails
     */
    public function insert($record)
    {
        $record->uuid = $this->genUuid();
        $dbtime_now = $this->toDbDateTime();
        $record->created_dt = $dbtime_now;
        $record->updated_dt = $dbtime_now;

        $this->beforeInsert($record);

        // Convert to array for Mongo to understand
        $arrModel = $record->toArray();
        $arrModel['_id'] = new \MongoId();
        $record->sid = (string)$arrModel['_id'];

        $this->db_collection->insert( $arrModel );

        return $record;
    }

    /**
     * Retrieves a single record.
     *
     * @param  int $criteria  The primary key for the search
     * @return AccessControl
     */
    public function find($criteria)
    {
        $doc = $this->db_collection->findOne( $criteria );

        $record = null;
        if (!empty($doc))
        {
            $record = $this->toModel($doc);
        }

        return $record;
    }

    /**
     * Retrieves a single record.
     *
     * @param  int $pk  The primary key for the search
     * @return AccessControl
     */
    public function findByPK($pk)
    {
        $criteria = array( '_id' => new \MongoId($pk) );
        return $this->find($criteria);
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

        // Convert to array for Mongo to understand
        $arrModel = $record->toArray();
        $criteria = array( '_id' => new \MongoId($pk) );
        $this->db_collection->update( $criteria, $arrModel );

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
        $record = $this->find($pk);
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
        $record = $this->findByPK($pk);
        if (!empty($record)) {
            $criteria = array( '_id' => new \MongoId($pk) );
            $this->db_collection->remove( $criteria );
            return $record;
        }
        return null;
    }

    /**
     * Returns the Laravel model object
     */
    protected function toModel($doc)
    {
        $model = $this->newModel();
        $model->sid = (string)$doc['_id'];
        $model->fill($doc);
        return $model;
    }

    protected function toDbDateTime($time = null)
    {
        if (empty($time))
            return null;
        return \MongoDate($time);
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