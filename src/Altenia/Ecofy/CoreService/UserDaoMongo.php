<?php namespace Altenia\Ecofy\CoreService;

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
        parent::__construct('Altenia\Ecofy\CoreService\User', $collectionName);
    }


    protected function toModel($doc)
    {
        $model = new User;
        $model->sid = (string)$doc['_id'];

        $model->fill($doc);
        $model->password = array_get($doc, 'password', '-');

        return $model;
    }
    
}