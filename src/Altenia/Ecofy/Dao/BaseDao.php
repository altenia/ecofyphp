<?php namespace Altenia\Ecofy\Dao;

/**
 * Helper class that provides HTML rendering functionalites.
 */
abstract class BaseDao {

	protected $modelName;

	public function __construct($modelName)
    {
    	$this->modelName = $modelName;
    }

    /**
     * Returns model's classname
     */
    public function modelClassName()
    {
        return '\'' . $this->modelName;
    }

    public function newModel()
    {
    	$modelClassName = $this->modelClassName();
    	$model = new $modelClassName();
    }

    // Template method called prior insertion
    public function beforeInsert(&$record)
    {}

    // Tempalte method called prio update
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
     * Update the specified resource in storage.
     *
     * @param  int   $pk    The primary key of the record to update
     * @param  array $data  The data of the update
     * @return mixed null if successful, validation if validation error
     */
    abstract public function update($pk, $data);


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $pk
     * @return Object the object that was deleted, null if not found
     */
    abstract public function delete($pk);
}
