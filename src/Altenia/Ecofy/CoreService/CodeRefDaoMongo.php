<?php namespace Altenia\Ecofy\CoreService;

use Altenia\Ecofy\Dao\BaseDaoMongo;

/**
 * Service class that provides business logic for CodeRef
 */
/* implements CodeRefProviderInterface */
class CodeRefDaoMongo extends BaseDaoMongo  {

    /**
     * Constructor
     */
    public function __construct($collectionName = 'code_ref')
    {
        parent::__construct('Altenia\Ecofy\CoreService\CodeRef', $collectionName);
    }


    protected function toModel($doc)
    {
        $model = new CodeRef;
        $model->sid = (string)$doc['_id'];

        $model->fill($doc);
        $model->password = array_get($doc, 'password', '-');

        return $model;
    }
    
}