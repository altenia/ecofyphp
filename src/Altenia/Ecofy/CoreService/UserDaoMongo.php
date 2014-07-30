<?php namespace Altenia\Ecofy\CoreService;

use Altenia\Ecofy\Dao\BaseDaoMongo;

/**
 * Service class that provides business logic for User
 */
/* implements UserProviderInterface */
class UserDaoMongo extends BaseDaoMongo  {

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct('Altenia\Ecofy\CoreService\User');
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