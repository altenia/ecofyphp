<?php namespace Altenia\Ecofy\CoreService;

use Altenia\Ecofy\Dao\BaseDaoMongo;

/**
 * Service class that provides business logic for Role
 */
/* implements RoleProviderInterface */
class RoleDaoMongo extends BaseDaoMongo  {

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct('Altenia\Ecofy\CoreService\Role');
    }


    protected function toModel($doc)
    {
        $model = new Role;
        $model->sid = (string)$doc['_id'];

        $model->fill($doc);
        $model->password = array_get($doc, 'password', '-');

        return $model;
    }
    
}