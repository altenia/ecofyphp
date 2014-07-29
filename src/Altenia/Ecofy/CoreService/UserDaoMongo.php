<?php namespace Altenia\Ecofy\CoreService;

/**
 * namespace is same as the foldername
 * There should be an entry in composer.json
 * in the array property autoload.classmap
 * additional element: "app/services"
 */

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
        parent::__construct('User');
    }


    private function toModel($doc)
    {
        $model = new \User;
        $model->sid = (string)$doc['_id'];

        $model->fill($doc);
        $model->password = array_get($doc, 'password', '-');

        return $model;
    }
    
}