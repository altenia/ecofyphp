<?php namespace Altenia\Ecofy\Support;

/**
 * Helper class that Builds Eloquent query from criteria.
 */
class QueryBuilderEloquent {

	/**
	 * Operator mapping
	 */
	static $op_map = array('eq' => '=', 'ne' => '<>', 'gt' => '>', 'lt' => '<', 'ge' => '>=', 'le' => '<=');

	/**
	 * Parses the query params (key-value pairs) to Mongo compliant
	 * query.
	 * The keys in the $queryParams is of format 'colname'[-{operator}]
	 * where operator is can be one of 'eq', 'gt', 'ge', 'lt', 'le', 'like'
	 * Examples: 
	 *   name-eq => 'John'
	 *   age-ge => 18
	 * 
	 * @param $criteria    - Query criteria based on Mongo
	 * @param &$query      - The query object (Either Elquent query or just an array())
	 */
	public function buildQuery($criteria, &$query)
	{
        foreach ($criteria as $key => $val) {
        	// the key can either be a property or logical op.
        	if ($key[0] == '$') {
        		$this->handleLogicOp($key, $val, $query);
        	} else {
        		if (is_array($val)) {
        			/* Same column, multiple statements:
        			 [ 
        			 	"time" => ["gt" => "10-10-01", "gt" => "10-10-01"] 
        			 ]
        			*/
        			foreach($val as $compOp => $compVal) {
	        			//$compOp = array_keys($val)[0];
	        			//$compVal = array_values($val)[0];

	    				// PHP converts dot into underscore, therefore : is used
	    				// to indicate alias.
	    				// convert : to . for SQL
	        			$col = str_replace(':', '.', $key);
	        			$this->handleCompOp($col, $compOp, $compVal, $query);
        			}
        		} else {
        			if (!empty($val)) {
        				// PHP converts dot into underscore, therefore : is used
        				// to indicate alias.
        				// convert : to . for SQL
        				$col = str_replace(':', '.', $key);
        				$query->where($col, '=', $val);
        			}
        		}
        	}
        }
        return $query;
	}

	private function handleCompOp($key, $op, $val, &$query)
	{
		switch ($op) {
			case '$gt':
				$query->where($key, '>', $val);
				break;
			case '$gte':
				$query->where($key, '>=', $val);
				break;
			case '$in':
				$query->whereIn($key, $val);
				break;
			case '$lt':
				$query->where($key, '<', $val);
				break;
			case '$lte':
				$query->where($key, '<=', $val);
				break;
			case '$ne':
				$query->where($key, '!=', $val);
				break;
			case '$nin':
				$query->whereNotIn($key, $val);
				break;
			case '$like':
				$query->where($key, 'LIKE', $val);
				break;
		}
		
	}

	private function handleLogicOp($key, $op, $criteria, &$query)
	{
		// @todo - PENDING
		switch ($op) {
			case '$or':
				$query->orWhere($key, '>', $val);
				break;
			case '$and':
				$query->where($key, '>=', $val);
				break;
			case '$not':
				$query->whereIn($key, $val);
				break;
			case '$nor':
				$query->where($key, '<', $val);
				break;
		}
	}
}