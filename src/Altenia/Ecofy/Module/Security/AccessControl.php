<?php namespace Altenia\Ecofy\Module\Security;

use Illuminate\Database\Eloquent\Model;

/**
 * Models from schema: docuflow version 0.1
 * Code generated by TransformTask
 *
 */

class AccessControl extends Model {

    /**
	 * The database table used by the model.
	 *
	 * @var string
	 */
    protected $table = 'access_controls';

    /**
	 * The primary key column name.
	 *
	 * @var string
	 */
	protected $primaryKey = 'sid';

	/**
	 * To disable created_at and updated_at.
	 *
	 * @var boolean
	 */
	public $timestamps = false;


    /**
	 * The field list for mass assignment.
	 *
	 * @var array
	 */
    protected $fillable = array('domain_sid','domain_id','owner_sid','creator_sid','created_dt','updated_by','updated_dt','update_counter','uuid','lang','role_sid','service','permissions','policy','params_text');

    /**
     * Validation rules for creation
     *
     * @var array
     */
    private static $validation_rules_create = array(
        'role_sid' => 'required',
		'service' => 'required|alpha_dash|min:2',
		'permissions' => 'required|numeric'
    	);

    /**
     * Validation rules for update
     *
     * @var array
     */
    private static $validation_rules_update = array(
        'role_sid' => 'required',
		'service' => 'required|alpha_dash|min:2',
		'permissions' => 'required|numeric'
    	);

    /**
     * Returns the validation object
     */
    public static function validator($fields, $is_create = true)
    {
    	$rules = ($is_create) ? static::$validation_rules_create : static::$validation_rules_update;
        $validator = Validator::make($fields, $rules);

        return $validator;
    }


    public function setPolicyFromJson($policyJson)
    {
        $this->policy = json_decode($policyJson, true);
        // @todo: traverse and parse non-numeric @permissions

        //print_r($this->policy);
    }

    //////////

    public function getName()
    {
        return $this->service;
    }
    
    const ATTR_PERMISSIONS = '@permissions';

    const FLAG_NONE = 0;

    const FLAG_OWN_READ = 1; // read my own
    const FLAG_OWN_LIST = 2; // list my own
    const FLAG_OWN_UPDATE = 4;
    const FLAG_OWN_DELETE = 8;

    const FLAG_READ = 16;
    const FLAG_LIST = 32;
    const FLAG_UPDATE = 64;
    const FLAG_CREATE = 128;
    const FLAG_DELETE = 256;

    const FLAG_IMPORT = 1024;
    const FLAG_EXPORT = 2048;
    const FLAG_ADMIN = 4096;

    public static function getPermissionsList() {
        $opt_permissions = array();
        $opt_permissions[self::FLAG_OWN_READ]   = 'read-owned';
        $opt_permissions[self::FLAG_OWN_LIST]   = 'list-owned';
        $opt_permissions[self::FLAG_OWN_UPDATE] = 'update-owned';
        $opt_permissions[self::FLAG_OWN_DELETE] = 'delete-owned';
        $opt_permissions[self::FLAG_READ]   = 'read';
        $opt_permissions[self::FLAG_LIST]   = 'list';
        $opt_permissions[self::FLAG_UPDATE] = 'update';
        $opt_permissions[self::FLAG_CREATE] = 'create';
        $opt_permissions[self::FLAG_DELETE] = 'delete';

        $opt_permissions[self::FLAG_IMPORT]  = 'import';
        $opt_permissions[self::FLAG_EXPORT]  = 'export';
        $opt_permissions[self::FLAG_ADMIN]  = 'admin';
        return $opt_permissions;
    }

    /*
    Example:
    permissions = 3 (read | update)
    policy  = {
        "doc:fal1": {
            "@permissions": 7 (read | update | create)
            "field:access_code": { "@permissions": 0 }
        } 
    }
    check(2, "doc:fal1/field:anyother") --> true
    check(4, "doc:fal1/field:anyother") --> true
    check(4, "doc:fal1/field:access_code") --> false
    check(4, "doc:fal2") --> false
    */


    /**
     * Adds or updates an entry to the policy
     */
    public function updatePolicy($resourcePathStr, $permissions)
    {
        $resourcePath = explode('/', $resourcePathStr);

        if ($this->policy == null) {
            $this->policy = array();
        }
        //$policyNode = $this->policy;
        $policyRoot = $this->policy;
        $policyNode = &$policyRoot;

        foreach ($resourcePath as $resourcePathEl) {
            if (array_key_exists($resourcePathEl, $policyNode)) {
                $policyNode = &$policyNode[$resourcePathEl];
            } else {
                // unexistent element, add
                $policyNode[$resourcePathEl] = array();
                $policyNode = &$policyNode[$resourcePathEl];
            }
        }

        $policyNode[self::ATTR_PERMISSIONS] = $permissions;

        $this->policy = $policyRoot;

        return $this->policy;
    }


    /**
     * $permission {number}   The bit number of the permission
     * $resourcePath {string} The path of the resource with dot notation
     *                        for the hierarchy. G.g.
     *                        doc:fal1/field:name
     */
    public function check($premission, $resourcePathStr)
    {
        $resourcePermission = $this->getPermissions($resourcePathStr);
        return ($resourcePermission & $premission) > 0;
    }

    /**
     * Returns the permission bit flag.
     *
     * @param {string} $resourcePathStr  
     */
    public function getPermissions($resourcePathStr)
    {
        $resourcePermission = $this->permissions;
        if (isset($this->policy) && !empty($this->policy) && !empty($resourcePathStr)) {
            $resourcePath = explode('/', $resourcePathStr);
            $policyNode = $this->policy;
            foreach ($resourcePath as $resourcePathEl) {
                if (array_key_exists($resourcePathEl, $policyNode)) {
                    $policyNode = $policyNode[$resourcePathEl];
                    $resourcePermission = array_key_exists(self::ATTR_PERMISSIONS, $policyNode) ? $policyNode[self::ATTR_PERMISSIONS]: 0;
                }
            }
            
        }
        return $resourcePermission;
    }

}
