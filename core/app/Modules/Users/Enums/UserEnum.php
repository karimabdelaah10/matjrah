<?php

namespace App\Modules\Users\Enums;

abstract class UserEnum
{

    public static function types()
    {
        return [
            'admin',
            'company',
        ];
    }
}
