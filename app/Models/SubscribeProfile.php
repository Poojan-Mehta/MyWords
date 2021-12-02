<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscribeProfile extends Model
{
    use HasFactory;

    protected $fillable = ['subscribe_from','subscribe_to'];

    // protected $with = ['subscribedusers'];

    // public function subscribedusers(){
    //     return $this->hasMany('App\Models\User','subscribe_from','id');
    // }
}
