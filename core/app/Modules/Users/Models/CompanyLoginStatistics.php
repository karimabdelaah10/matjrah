<?php

namespace App\Modules\Users\Models;

use App\Modules\Users\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyLoginStatistics extends Model
{
    use HasFactory;
    protected $table='company_login_statistics';
    protected $fillable=[
        'date',
        'company_id'
    ];
    public function companies(){
        return $this->belongsTo(User::class, 'company_id');
    }
    public $timestamps =false;
}
