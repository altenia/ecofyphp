<?php namespace Altenia\Ecofy\CoreService;

use Illuminate\Database\Eloquent\Model;

/**
 * Models from schema: ecofy version 0.1
 * Code generated by TransformTask
 *
 */

class Comment extends Model {

    /**
	 * The database table used by the model.
	 *
	 * @var string
	 */
    protected $table = 'comments';

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
    protected $fillable = array('uuid','domain_sid','domain_id','created_by','created_dt','updated_by','updated_dt','update_counter','lang','object_type','object_sid','title','content','attachments','privacy_level','params_text');

    /**
     * Validation rules for creation
     *
     * @var array
     */
    private static $validation_rules_create = array(
        
    	);

    /**
     * Validation rules for update
     *
     * @var array
     */
    private static $validation_rules_update = array(
        
    	);

    /**
     * Returns the validation object
     */
    public static function validator($fields, $is_create = true)
    {
    	$rules = ($is_create) ? static::$validation_rules_create : static::$validation_rules_update;
        $validator = \Validator::make($fields, $rules);

        return $validator;
    }

    public function document()
    {
        return $this->belongsTo('Document');
    }
}
