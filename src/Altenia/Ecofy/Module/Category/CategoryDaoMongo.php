<?php namespace Altenia\Ecofy\Module\Category;

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
        parent::__construct('Altenia\Ecofy\Module\Category\Category', $collectionName);
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