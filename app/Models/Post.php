<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Post extends Authenticatable
{
    use HasFactory;
    protected $guard = ['admin'];

    protected $fillable = [
        'post_title',
        'post_body'
    ];

    public function user(){
        return $this->belongsTo('App\Models\User','user_id');
    }

    public function bookmarks()
    {
        return $this->belongsToMany('App\Models\User', 'post_bookmarks','post_id','user_id');
    }

    public function is_bookmarked(User $user){
        return $this->post_bookmarks->contains($user);
    }
}
