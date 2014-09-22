<?php namespace Altenia\Ecofy\CoreService;

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
        parent::__construct('Altenia\Ecofy\CoreService\Person');
    }


    public function buildQuery($criteria)
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
        $aliasedCols = array_map(function($val){
        	return 'persons.' . $val;
        }, $cols);
        return $query->select($aliasedCols); 
    }

    public function queryByFamily($criteria, $sortParams = array(), $offset = 0, $limit=100)
    {
    	$query = $this->buildQuery($criteria);
        // @todo - orderBy()->get()
        $records = $query->skip($offset)->take($limit)->orderBy('hof_person.name_lc', 'asc')->get();

        return $records;
    }

}