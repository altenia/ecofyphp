<?php namespace Altenia\Ecofy\Dao;

use Altenia\Ecofy\Dao\Schema\Schema;
use Altenia\Ecofy\Util\UuidUtil;

/**
 * Helper class that provides HTML rendering functionalites.
 */
abstract class BaseDao {

	protected $modelFqn;

    protected $schema;

	public function __construct($modelFqn)
    {
    	$this->modelFqn = $modelFqn;
        $this->schema = new Schema;
    }

    public function setSchema($schema)
    {
        $this->schema = $schema;
    }

    public function getSchema()
    {
        return $this->schema;
    }

    /**
     * Returns model's classname
     */
    public function modelClassName()
    {
        return '\\' . $this->modelFqn;
    }

    public function newModel()
    {
    	$modelClassName = $this->modelClassName();
    	$model = new $modelClassName();
    }

    public function genUuid()
    {
        return UuidUtil::generate();
    }

    // Template method called prior insertion
    public function beforeInsert(&$record)
    {
        // Make proper conversion of value representation, e.g. ISO date to MySQL's
        /* Seems like Laravel getDates() already provide this functianality
        $fields = $this->schema->getFields();
        foreach ($fields as $fieldName => $dataType) {
            if ($dataType->getName() === 'DateTime') {
                if (isset($record->$fieldName)) {
                    $record->$fieldName = $this->toDbDateTime($record->$fieldName)
                }
            }
        }*/
    }

    // Template method called prior update
    public function beforeUpdate(&$record)
    {}

    abstract public function query($criteria, $sortParams = array(), $offset = 0, $limit=100);

    /**
     * Returns the count of records satisfying the critieria.
     *
     * @param array $queryParams  Parameters used for querying
     * @return int number of records that satisfied the criteria
     */
    abstract public function count($criteria);

    /**
     * Inserts record.
     * Mostly wrapper around insert with pre and post processing.
     *
     * @param array $record  Model tha has already validated
     * @return mixed  null if successful, validation object validation fails
     */
    abstract public function insert($record);

    /**
     * Retrieves a single record.
     *
     * @param  int $pk  The primary key for the search
     * @return Transaction
     */
    abstract public function find($criteria);

    /**
     * Retrieves a single record.
     *
     * @param  int $pk  The primary key for the search
     * @return AccessControl
     */
    abstract public function findByPK($pk);

    /**
     * Update the specified resource.
     *
     * @param  int   $pk    The primary key of the record to update
     * @param  array $data  The data of the update
     * @return mixed null if successful, validation if validation error
     */
    abstract public function update($record);

    /**
     * Update the fields.
     *
     * @param  int   $pk    The primary key of the record to update
     * @param  array $data  Fields to update
     * @return mixed Returns the newely updated record
     */
    abstract public function updateFields($pk, $data);


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $pk
     * @return Object the object that was deleted, null if not found
     */
    abstract public function delete($pk);

    /**
     * @param $date Either null or string in iso format
     */
    abstract public function toDbDateTime($time);
}
