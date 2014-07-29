<?php namespace Altenia\Ecofy\Dao;

/**
 * Helper class that provides HTML rendering functionalites.
 */
class MongoDb {

	private $db_connection;
    private $db_db;

    public static $db_name;

    public static function setDbName($dbName)
    {
        self::$db_name = $dbName;
    }

    /**
     * Constructor
     */
    public function __construct($dbName = null)
    {
    	if (empty($dbName)) {
    		$dbName = self::$db_db;
    	}
        $this->db_connection = new \MongoClient();
        $this->db_db = $this->db_connection->selectDB($dbName);
    }

    /**
     *
     */
    public function selectCollection($collectionName)
    {
    	return $this->db_collection = $this->db_db->selectCollection($collectionName);
    }

    /**
     *
     */
    public function createCollection($collectionName, $indexes)
    {
    	$collection = $this->db_collection = $this->db_db->createCollection($collectionName);

    	if (!empty($indexes))
    	{
    		foreach ($indexes as $index_info)
    		{
    			$collection->createIndex( array($index_info['columns'][0] => 1) );
    		}
    	}

    	return $collection;
    }
}