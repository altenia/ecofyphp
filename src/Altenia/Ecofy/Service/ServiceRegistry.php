<?php namespace Altenia\Ecofy\Service;


/**
 * ServiceRegistry maintains a 
 */
class ServiceRegistry {

    private $services = array();

    private $servicesById = array();

    /**
     * Returns list of the records.
     *
     * @return array of all registered services
     */
    public function listServices()
    {
        return $this->services;
    }

    /**
     * Creates a new records.
     * Mostly wrapper around insert with pre and post processing.
     *
     * @param array $data  Parameters used for creating a new record
     * @return mixed  null if successful, validation object validation fails
     */
    public function addServiceEntry($id, $title, $url, $icon, $permission = \AccessControl::FLAG_READ)
    {
        $entry = new \stdClass;
        $entry->title = $title;
        $entry->url = $url;
        $entry->icon = $icon;
        $entry->permission = $permission; 
        $entry->reference = \App::make('svc:' . $id); 

        $this->services[] = $entry;
        $this->servicesById[$entry->reference->getId()] = $entry;
    }

    /**
     * Creates a new records.
     * Mostly wrapper around insert with pre and post processing.
     *
     * @param array $data  Parameters used for creating a new record
     * @return mixed  null if successful, validation object validation fails
     */
    public function addService($data)
    {
        $this->addServiceEntry($data['id'], $data['title'], $data['url'], $data['icon'], $data['reference'], $data['permission']);
    }

    /**
     * Retrieves a single record.
     *
     * @param  int $id  The primary key for the search
     * @return User
     */
    public function findServiceById($id)
    {
        if (array_key_exists($id, $this->servicesById)) {
            return $this->servicesById[$id];
        }

        return null;
    }


}