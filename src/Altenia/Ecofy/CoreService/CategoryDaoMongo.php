<?php namespace Altenia\Ecofy\CoreService;

use Altenia\Ecofy\Dao\BaseDaoMongo;

/**
 * Service class that provides business logic for Category
 */
/* implements CategoryProviderInterface */
class CategoryDaoMongo extends BaseDaoMongo  {

    /**
     * Constructor
     */
    public function __construct($collectionName = 'category')
    {
        parent::__construct('Altenia\Ecofy\CoreService\Category', $collectionName);
    }


    protected function toModel($doc)
    {
        $model = new Category;
        $model->sid = (string)$doc['_id'];

        $model->fill($doc);
        $model->password = array_get($doc, 'password', '-');

        return $model;
    }
    
}