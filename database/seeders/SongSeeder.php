<?php

namespace Database\Seeders;

use App\Models\Song;
use Illuminate\Database\Seeder;

class SongSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $songs = [
            'song_name'=>"A Sailor Went To Sea",
            'song_lyrics'=> "A sailor went to sea, sea, sea
                            To see what he could see, see, see
                            But all that he could see, see, see
                            Was the bottom of the deep blue sea, sea, sea!
                            
                            A sailor went to knee, knee, knee
                            To see what he could knee, knee, knee
                            But all that he could knee, knee, knee
                            Was the bottom of the deep blue knee, knee, knee!
                            Sea, sea, sea
                            
                            A sailor went to chop, chop, chop
                            To see what he could chop, chop, chop
                            But all that he could chop, chop, chop
                            Was the bottom of the deep blue chop, chop, chop!
                            Knee, knee, knee
                            Sea, sea, sea",
            'song_description'=> "A sailor went to sea, sea, sea
                                    To see what he could seee",
            'artist_id'=>1            
        ];

        Song::create($songs);
    }
}
