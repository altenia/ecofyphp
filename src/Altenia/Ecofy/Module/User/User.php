<?php namespace Altenia\Ecofy\Module\User;

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Auth\Reminders\RemindableTrait;

use Illuminate\Database\Eloquent\Model;


class User extends Model implements UserInterface, RemindableInterface {

    use UserTrait, RemindableTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

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
    protected $fillable = array('created_dt','updated_dt','updated_counter','uuid','organization_sid','organization_name','id','password','role_sid','role_name','given_name','middle_name','family_name','name_nl','name','dob','phone','email','permalink','activation_code','security_question','security_answer','session_timestamp','last_session_ip','last_session_dt','login_fail_counter','active','status','default_lang_cd','timezone','expiry_dt','type','params_text');

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array('password', 'remember_token');

    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->password;
    }

    /**
     * Get the e-mail address where password reminders are sent.
     *
     * @return string
     */
    public function getReminderEmail()
    {
        return $this->email;
    }


    private static $validation_rules_create = array(
        'id' => 'required|min:4',
        //'password' => 'required|min:4',
        'given_name' => 'required|min:2',
        'email' => 'required|email'
        );

    private static $validation_rules_update = array(
        'id' => 'min:4',
        'given_name' => 'min:2',
        'email' => 'email'
        );

    /**
     * Validation
     */
    public static function validator($fields, $is_create = true)
    {
        $rules = ($is_create) ? static::$validation_rules_create : static::$validation_rules_update;
        $validator = \Validator::make($fields, $rules);

        return $validator;
    }

    public function organization()
    {
        return $this->belongsTo('Organization', 'org_sid', 'sid');
    }

    ////////// Custom 

    public function getName()
    {
        return $this->getFullName();
    }

    public function getAttributes()
    {
        return json_decode($this->params_text, true);
    }

    public function getOrgProperty($property, $default = null)
    {
        $org = $this->organization;
        if (!empty($org)){
            return $org[$property];
        } 
        return $default;
    }

    public function getOrgSid()
    {
        return $this->getOrgProperty('sid');
    }

    public function getOrgName()
    {
        return $this->getOrgProperty('name');
    }

    // Get user full-name
    public function getFullName()
    {
        if (!empty($this->name))
            return $this->name;
        return $this->given_name . ' ' . $this->family_name;
    }
}