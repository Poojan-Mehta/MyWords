<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    use HasFactory;

    protected $fillable = [
        'song_name',
        'song_lyrics',
        'song_description',
        'artist_id',
        'tags'
    ];    

    //protected $with = ['artist'];

    public function artist(){
        return $this->belongsTo('App\Models\User','artist_id','id');
    }
}
