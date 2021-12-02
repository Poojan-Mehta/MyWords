<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Roles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'profile_photo',
        'cover_photo'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $with = ['roles','subscribedProfile','songs'];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //old
    public function bookmarks(){
        return $this->hasMany('App\Models\Post','post_bookmarks','user_id','post_id');
    }    

    public function roles(){
        return $this->belongsTo('App\Models\Roles','role_id','id');
    }

    public function songs(){
        return $this->hasMany('App\Models\Song','artist_id','id');
    }

    public function subscribedProfile(){
        return $this->hasMany('App\Models\SubscribeProfile','subscribe_to','id');
    }
}
