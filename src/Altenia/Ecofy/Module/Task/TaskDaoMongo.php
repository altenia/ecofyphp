<?php namespace Altenia\Ecofy\Module\Task;

use Altenia\Ecofy\Dao\BaseDaoMongo;

/**
 * Service class that provides business logic for Task
 */
/* implements TaskProviderInterface */
class TaskDaoMongo extends BaseDaoMongo  {

    /**
     * Constructor
     */
    public function __construct($collectionName = 'task')
    {
        parent::__construct('Altenia\Ecofy\Module\Task\Task', $collectionName);
    }


    protected function toModel($doc)
    {
        $model = new Task;
        $model->sid = (string)$doc['_id'];

        $model->fill($doc);

        return $model;
    }
    
}