<?php namespace Altenia\Ecofy\Module\User;

use Altenia\Ecofy\Service\BaseDataService;
use Altenia\Ecofy\Service\ValidationException;

/**
 * Service class that provides business logic for User
 */
/* implements UserProviderInterface */
class UserService extends BaseDataService  {

    /**
     * Constructor
     */
    public function __construct($dao, $id = 'user')
    {
        parent::__construct($dao, $id);
    }

    /**
     * Returns list of the records.
     *
     * @param array $queryParams  Parameters used for querying
     *                            They key is of format "colname-op"
     * @param int   $offset       The starting record
     * @param int   $limit        Maximum number of records to retrieve
     * @return Response
     */
    public function listUsers($criteria, $sortParams = array(), $offset = 0, $limit=100)
    {
        return $this->dao->query($criteria, $sortParams, $offset, $limit);
    }

    /**
     * Returns paginated list of the records.
     *
     * @param array $criteria     Parameters used for querying
     * @param int   $page_size    The max number of entries shown per page
     * @return Response
     */
    public function paginateUsers($criteria, $sortParams = array(), $page_size = 20)
    {
        return $this->dao->paginate($criteria, $sortParams, $page_size);
    }

    /**
     * Returns the count of records satisfying the critieria.
     *
     * @param array $criteria  Parameters used for querying
     * @return int number of records that satisfied the criteria
     */
    public function countUsers($criteria)
    {
       return $this->dao->count($criteria);
    }

    /**
     * Creates a new records.
     * Mostly wrapper around insert with pre and post processing.
     *
     * @param array $data  Parameters used for creating a new record
     * @return mixed  the newly inserted model, null if failed
     */
    public function createUser($data)
    {
        if (!array_key_exists('id', $data)) {
            $data['id'] = str_replace('@', '_', $data['email']);
        }
        if (empty($data['name'])) {
            $data['name'] = $data['given_name'] . ' ' . $data['family_name'];
        }

        $validator = User::validator($data);
        if ($validator->passes()) {
            $record = new User();
            $record->fill($data);
            $this->populateRoleName($record);

            if (array_key_exists('HTTP_CLIENT_IP', $_SERVER)) {
                $record->last_session_ip = $_SERVER['HTTP_CLIENT_IP'];
            }
            $record->password = \Hash::make($data['password']);

            $record = $this->dao->insert($record);

            // Send verification email

            return $record;
        } else {
            throw new ValidationException($validator);
        }
    }

    /**
     * Retrieves a single record.
     *
     * @param  int $criteria  The critieria that retrieves on entry
     * @return User
     */
    public function findUser($criteria)
    {
        return $this->dao->find($criteria);
    }

    /**
     * Retrieves a single record.
     *
     * @param  int $pk  The primary key for the search
     * @return User
     */
    public function findUserByPK($pk)
    {
        return $this->dao->findByPK($pk);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  int   $pk    The primary key of the record to update
     * @param  array $data  The data of the update
     * @return mixed null if successful, validation if validation error
     */
    public function updateUser($pk, $data)
    {

        $validator = User::validator($data, false);
        if ($validator->passes()) {

            $model = $this->findUserByPK($pk);
            if (array_key_exists('id', $data)) {
                // Check that id is not in use
                $idCriteria = array('id' => $data['id']); 
                $matchingUser = $this->findUser($idCriteria);
                if (!empty($matchingUser) && $matchingUser->sid !== $model->sid) {
                    $validator = array('id' => 'ID already in use');
                    throw new ValidationException($validator);
                }
            }


            $model->fill($data);
            $this->populateRoleName($model);

            if (array_key_exists('password', $data)) {
                $model->password = \Hash::make($data['password']);
            }
            
            return $this->updateUserModel($model);
        } else {
            throw new ValidationException($validator);
        }
    }

    public function updateUserModel($model)
    {
        if (array_key_exists('HTTP_CLIENT_IP', $_SERVER)) {
            $model->last_session_ip = $_SERVER['HTTP_CLIENT_IP'];
        }
        
        return $this->dao->update( $model );
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $pk
     * @return Object the object that was deleted, null if not found
     */
    public function destroyUser($pk)
    {
        return $this->dao->delete($pk);
    }

    
    /**
     * Activate use 
     */
    public function activateUser($pk, $code)
    {
        // @todo
    }

    private function toModel($doc)
    {
        $model = new \User;
        $model->sid = (string)$doc['_id'];

        $model->fill($doc);
        $model->password = array_get($doc, 'password', '-');

        return $model;
    }

    /**
     * If a role_sid was assigned and role_name is empty, 
     * fill the role_name from the database
     */
    private function populateRoleName(&$record)
    {
        if ( isset($record->role_sid) && !empty($record->role_sid))
        {
            if (!isset($record->role_name) || empty($record->role_name))
            {
                $role = $this->getRoleService()->findRoleByPK($record->role_sid);
                $record->role_name = $role->name;  
            }
        }
    }

    private function getRoleService()
    {
        return \App::make('svc:role');
    }
    
}