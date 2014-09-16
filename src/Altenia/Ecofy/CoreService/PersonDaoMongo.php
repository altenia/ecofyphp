<?php namespace Altenia\Ecofy\CoreService;

use Altenia\Ecofy\Dao\BaseDaoMongo;

/**
 * Service class that provides business logic for Person
 */
/* implements PersonProviderInterface */
class PersonDaoMongo extends BaseDaoMongo  {

    /**
     * Constructor
     */
    public function __construct($collectionName = 'person')
    {
        parent::__construct('Altenia\Ecofy\CoreService\Person', $collectionName);
    }


    protected function toModel($doc)
    {
        $model = new Person;
        $model->sid = (string)$doc['_id'];

        $model->fill($doc);
        $model->password = array_get($doc, 'password', '-');

        return $model;
    }
    
}