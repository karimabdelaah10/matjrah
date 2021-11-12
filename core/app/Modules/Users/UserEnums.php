<?php

namespace App\Modules\Users;

abstract class UserEnums
{
    /**
     * List of all user's type used in users table
     */
    public const ADMIN_TYPE = 'admin',
        SUPER_ADMIN_TYPE = 'super_admin',
        CUSTOMER = 'customer';

    public static function userTypes()
    {
        return [
            self::ADMIN_TYPE => self::ADMIN_TYPE,
            self::SUPER_ADMIN_TYPE => self::SUPER_ADMIN_TYPE,
            self::CUSTOMER => self::CUSTOMER
        ];
    }

    public static function creatableUserTypes()
    {
        return [
            self::ADMIN_TYPE => self::ADMIN_TYPE,
            self::SUPER_ADMIN_TYPE => self::SUPER_ADMIN_TYPE
        ];
    }


    /**
     * List of all customer's work_type used in customer table
     */
    public const CORPORATE = 'corporate',
        EMPLOYED = 'employed',
        SELF_EMPLOYED = 'self_employed';

    public static function customerWorkTypes()
    {
        return [
            self::CORPORATE => self::CORPORATE,
            self::EMPLOYED => self::EMPLOYED,
            self::SELF_EMPLOYED => self::SELF_EMPLOYED
        ];
    }
    public static function translatedWorkTypes()
    {
        return [
            self::CORPORATE =>  trans('users.CORPORATE'),
            self::EMPLOYED =>  trans('users.EMPLOYED'),
            self::SELF_EMPLOYED =>  trans('users.SELF_EMPLOYED')
        ];
    }
}
