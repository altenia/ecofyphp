<?php namespace Altenia\Ecofy\Support;

/**
 * Helper class that Builds Mongo criteria.
 */
class QueryBuilderMongo {


	/**
	 * Translates Criteria into Mongo compliant query.
	 * The only translation required is the $re which should be changed into
	 * new MongoRegex(varl)
	 * 
	 * @param $criteria - The input parameters from which the query is built
	 * @param &$query   - The query object (Either Elquent query or just an array())
	 */
	public function buildQuery($criteria)
	{
		$query = $criteria;
		
		if (!empty($query)) {
			$this->buildQueryRecursive($query);
		}
        
        return $query;
	}

	private function buildQueryRecursive(&$queryNode)
	{
		if (count($queryNode) > 0) {
			foreach($queryNode as $key => $val) {
				// If the value is array and key is '$re',
				// Replace it with new MongoRegex
				if (is_array($val)) {
					if (array_key_exists('$re', $val)) {
						$queryNode[$key] = new \MongoRegex('/'.$val['$re'].'/');
					} else {
						$this->buildQueryRecursive($val);
					}
				}
			}
		}
	}
}