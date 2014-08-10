<?php namespace Altenia\Ecofy\Service;


/**
 * ServiceRegistry maintains a 
 */
class ServiceRegistry {

    private $services = array();

    private $servicesById = array();

    private static $instance = null;

    /**
     * Returns the singleton instance of the ServiceRegistry
     */
    public static function instance(){
        if (!self::$instance){
            self::$instance = new ServiceRegistry();
        }
        return self::$instance;
    }


    /**
     * Creates a new records.
     * Mostly wrapper around insert with pre and post processing.
     *
     * @param $id, 
     * @param $title, 
     * @param $url, 
     * @param $icon, 
     * @param $reference either a closure or actual reference to the service.
     * @return mixed  null if successful, validation object validation fails
     */
    public function addEntry($id, $title, $url, $icon, $reference = null)
    {
        $entry = new \stdClass;
        $entry->title = $title;
        $entry->url = $url;
        $entry->icon = $icon;
        //$entry->permission = $permission; 

        if (is_callable($reference)) {
            $entry->reference = $reference();
        } else {
            $entry->reference = $reference;
        }
        if ($entry->reference == null) {
            $entry->reference = \App::make('svc:' . $id); 
        } 

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
    public function add($data)
    {
        $this->addEntry($data['id'], $data['title'], $data['url'], $data['icon'], $data['reference']);
    }


    /**
     * Returns list of all services
     *
     * @return array of all registered services
     */
    public function getAll()
    {
        return $this->services;
    }

    /**
     * Returns list of the services by type.
     *
     * @return array of all registered services
     */
    public function getByType($serviceType)
    {
        return $this->services;
    }

    /**
     * Retrieves a single record.
     *
     * @param  int $id  The primary key for the search
     * @return User
     */
    public function findById($id)
    {
        if (array_key_exists($id, $this->servicesById)) {
            return $this->servicesById[$id];
        }

        return null;
    }


}