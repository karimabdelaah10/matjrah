<?php

namespace App\Modules\Products\Models;

use App\Modules\BaseApp\BaseModel;
use App\Modules\Users\User;

class Product extends BaseModel
{
    protected $table = "products";
    protected $fillable = ['title', 'description', 'is_active', 'company_id'];

    public function scopeActive($query)
    {
        return $query->where('is_active', '=', 1);
    }

    public function company()
    {
        return $this->belongsTo(User::class, 'company_id');
    }
}
