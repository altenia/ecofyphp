<?php namespace Altenia\Ecofy\CoreService;

class PredefinedAcl
{
    private static $serviceAcl = array();

    public static function addAcl($role, $policyJson, $permission = 7)
    {
        if (self::$serviceAcl == null) {
            self::$serviceAcl = array();
        }
        $ac = new AccessControl();
        $ac->permissions = $permission;
        $ac->setPolicyFromJson($policyJson);
        self::$serviceAcl[$role] = $ac;
    }

    public static function get($role) {
        
        if (array_key_exists($role, self::$serviceAcl)) {
            return self::$serviceAcl[$role];
        }
        return null;
    }
}