<?php

namespace App\Modules\Users;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = "users";
    protected $fillable = [
        'name',
        'type',
        'email',
        'mobile_number',
        'address',
        'is_admin',
        'password',
        'is_active',
        'subdomain'
    ];

    public function setPasswordAttribute($value)
    {
        if (trim($value)) {
            $this->attributes['password'] = bcrypt(trim($value));
        }
    }

    public function setSubdomainAttribute($value)
    {
        $this->attributes['subdomain'] = strtolower(str_replace(' ', '_', trim($value)));
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', '=', 1);
    }

    public function scopeCompany($query)
    {
        return $query->where('type', '=', 'company');
    }

    public function scopeNotAdmin($query)
    {
        return $query->where('is_admin', '=', 0);
    }

    public function scopeNotSuperAdmin($query)
    {
        return $query->where('super_admin', '=', 0);
    }
}
