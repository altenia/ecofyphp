<?php namespace Altenia\Ecofy\CoreService;

use Altenia\Ecofy\Dao\BaseDaoMongo;

/**
 * Service class that provides business logic for Entity
 */
/* implements EntityProviderInterface */
class EntityDaoMongo extends BaseDaoMongo  {

    /**
     * Constructor
     */
    public function __construct($collectionName = 'entity')
    {
        parent::__construct('Altenia\Ecofy\CoreService\Entity', $collectionName);
    }


    protected function toModel($doc)
    {
        $model = new Entity;
        $model->sid = (string)$doc['_id'];

        $model->fill($doc);
        $model->password = array_get($doc, 'password', '-');

        return $model;
    }
    
}