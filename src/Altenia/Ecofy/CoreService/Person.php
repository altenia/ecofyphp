<?php namespace Altenia\Ecofy\CoreService;

use Illuminate\Database\Eloquent\Model;

/**
 * Models from schema: ecofy version 0.1
 * Code generated by TransformTask
 *
 */

class Person extends Model {

    /**
	 * The database table used by the model.
	 *
	 * @var string
	 */
    protected $table = 'persons';

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
    protected $fillable = array('uuid','domain_sid','domain_id','created_by','created_dt','updated_by','updated_dt','update_counter','lang'
        , 'id', 'user_sid', 'primary_lang', 'education_level', 'highlight', 'philosophy', 'goals', 'personality_type', 'name_lc', 'mobile_number'
        , 'location', 'country_cd', 'province_cd', 'district', 'address', 'postal_code'
        , 'additional_type', 'alternate_name', 'description', 'image', 'name', 'same_as', 'url', 'additional_name', 'address', 'affiliation', 'alumni_of', 'award', 'awards', 'birth_date', 'brand', 'children', 'colleague', 'colleagues', 'contact_point', 'contact_points', 'death_date', 'duns', 'email', 'family_name', 'fax_number', 'follows', 'gender', 'given_name', 'global_location_number', 'has_pos', 'home_location', 'honorific_prefix', 'honorific_suffix', 'interaction_count', 'isic_v4', 'job_title', 'knows', 'makes_offer', 'member_of', 'naics', 'nationality', 'owns', 'parent', 'parents', 'performer_in', 'related_to', 'seeks', 'sibling', 'siblings', 'spouse', 'tax_id', 'telephone', 'vat_id', 'work_location', 'works_for');

    /**
     * Validation rules for creation
     *
     * @var array
     */
    private static $validation_rules_create = array(
        'id' => 'required|alpha_dash|min:4',
		'name' => 'required|min:2',
		'url' => 'url',
		'country_cd' => 'min:2|max:3'
    	);

    /**
     * Validation rules for update
     *
     * @var array
     */
    private static $validation_rules_udpate = array(
        'id' => 'required|alpha_dash|min:4',
		'name' => 'required|min:2',
		'url' => 'url',
		'country_cd' => 'min:2|max:3'
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

    public function users()
    {
        return $this->hasMany('Users');
    }


    public function getName()
    {
        return $this->name;
    }
}