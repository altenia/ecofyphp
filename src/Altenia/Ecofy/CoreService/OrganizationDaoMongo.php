<?php namespace Altenia\Ecofy\CoreService;

use Altenia\Ecofy\Dao\BaseDaoMongo;

/**
 * Service class that provides business logic for Organization
 */
/* implements OrganizationProviderInterface */
class OrganizationDaoMongo extends BaseDaoMongo  {

    /**
     * Constructor
     */
    public function __construct($collectionName = 'organization')
    {
        parent::__construct('Altenia\Ecofy\CoreService\Organization', $collectionName);
    }


    protected function toModel($doc)
    {
        $model = new Organization;
        $model->sid = (string)$doc['_id'];

        $model->fill($doc);
        $model->password = array_get($doc, 'password', '-');

        return $model;
    }
    
}