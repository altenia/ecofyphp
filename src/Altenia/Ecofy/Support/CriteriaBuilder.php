<?php namespace Altenia\Ecofy\Support;

/**
 * Helper class that builds query criteria.
 */
class CriteriaBuilder {

	/**
	 * Operator mapping
	 */
	static $op_map = array('eq' => '=', 'ne' => '$ne', 'gt' => '$gt', 'lt' => '$lt'
		, 'ge' => '$gte', 'le' => '$lte', 're' => '$re');


	/**
	 * Parses the query params (key-value pairs) to Mongo compliant
	 * query.
	 * The keys in the $queryParams is of format 'colname'[-{operator}]
	 * where operator is can be one of 'eq', 'gt', 'ge', 'lt', 'le', 'like'
	 * Examples: 
	 *   name-eq => 'John'
	 *   age-ge => 18
	 * 
	 * @param $queryParams - The input parameters from which the query is built
	 */
	public function buildFromQueryParams($queryParams)
	{
		$criteria = array();
		// WHERE a=1 AND b= q : ["a" => 1, "b" => "q"] 
		// WHERE a > 10 : ["a" => ["$gt" => "10"] ]
		if (!empty($queryParams)) {
			foreach($queryParams as $queryKey => $queryVal) {
	            $dashPos = strpos($queryKey, '-');
	            $colname = $queryKey;
	            $operator = 'eq';
	            if ($dashPos !== false) {
	                $colname = substr($queryKey, 0, $dashPos);
	                $operator = substr($queryKey, $dashPos+1);
	            }
	            
	            if ($operator === 'eq') {
	            	$criteria[$colname] = $queryVal;
	            } else {
	            	$op = array_key_exists($operator, static::$op_map) ? static::$op_map[$operator] : '$' . $operator;
	            	//$criteria[$colname] = array($op => $queryVal);
	            	$criteria[$colname][$op] = $queryVal;
	            }
	        }
		}
        
        return $criteria;
	}
}