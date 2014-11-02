<?php namespace Altenia\Ecofy\Module\Task;

use Altenia\Ecofy\Dao\Schema\DataType;
use Altenia\Ecofy\Dao\BaseDaoEloquent;

/**
 * DAO class that provides business logic for User
 */
class TaskLogEntryDaoEloquent extends BaseDaoEloquent  {

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct('Altenia\Ecofy\Module\Task\TaskLogEntry');

        // For the mean time DateTime is specified to make proper conversion
        // on save and retreival
        $this->getSchema()->addField('created_dt', DataType::TYPE_DATETIME);
        $this->getSchema()->addField('updated_dt', DataType::TYPE_DATETIME);
        $this->getSchema()->addField('allocation_date', DataType::TYPE_DATETIME);
        $this->getSchema()->addField('actual_start_dt', DataType::TYPE_DATETIME);
        $this->getSchema()->addField('actual_end_dt', DataType::TYPE_DATETIME);
    }

}