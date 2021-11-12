<?php

namespace App\Modules;

use App\Modules\BaseApp\BaseModel;

class Token extends BaseModel{
    protected $fillable = [
        'user_id', 'token',
    ];
}

