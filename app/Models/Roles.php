<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    use HasFactory;

    protected $fillable = [
        'role_name'
    ];

    public function users()
    {
        //return $this->hasMany('App\Models\Users', 'role_id');
        return $this->hasMany('App\Models\Users');
    }
}
