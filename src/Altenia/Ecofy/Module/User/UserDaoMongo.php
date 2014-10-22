<?php namespace Altenia\Ecofy\Module\User;

use Altenia\Ecofy\Dao\BaseDaoMongo;

/**
 * DAO class that provides business logic for User
 */
class UserDaoMongo extends BaseDaoMongo  {

    /**
     * Constructor
     */
    public function __construct($collectionName = 'user')
    {
        parent::__construct('Altenia\Ecofy\Module\User\User', $collectionName);
    }


    protected function toModel($doc)
    {
        $model = new User;
        $model->sid = (string)$doc['_id'];

        $model->fill($doc);

        return $model;
    }
    
}