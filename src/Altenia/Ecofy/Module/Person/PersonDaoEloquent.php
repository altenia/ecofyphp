<?php namespace Altenia\Ecofy\Module\Person;

use Altenia\Ecofy\Dao\BaseDaoEloquent;
use Altenia\Ecofy\Support\QueryBuilderEloquent;

/**
 * DAO class that provides business logic for User
 */
class PersonDaoEloquent extends BaseDaoEloquent  {

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct('Altenia\Ecofy\Module\Person\Person');
    }


    /**
     * Builds query with join to head_of_family
     */
    public function buildQuery2($criteria)
    {
        $modelClassName = $this->modelClassName();
        if (empty($criteria)) $criteria = array();
        $queryBuilder = new QueryBuilderEloquent();
        $model = new $modelClassName;
        $query = $model->leftJoin('persons as hof_person', function($join) {
        	$join->on('persons.head_of_family', '=', 'hof_person.sid');
        });
        
        $query = $queryBuilder->buildQuery($criteria, $query);
        // This is required because the table is joined to the same table
        $cols = $model->getFillable();
        array_unshift($cols, 'sid', 'uuid', 'domain_sid', 'domain_id', 'created_by', 'created_dt', 'updated_by', 'updated_dt', 'update_counter', 'lang');
        $aliasedCols = array_map(function($val){
        	return 'persons.' . $val;
        }, $cols);
        return $query->select($aliasedCols); 
    }

    public function queryByFamily($criteria, $sortParams = array(), $offset = 0, $limit=100)
    {
    	$query = $this->buildQuery2($criteria);
        // @todo - orderBy()->get()
        $query = $query->skip($offset)->take($limit);
        if (!empty($sortParams)) {
            foreach($sortParams as $col => $direction ) {
                $query->orderBy($col, $direction);
            }
        }
        $records = $query->get();

        return $records;
    }

}