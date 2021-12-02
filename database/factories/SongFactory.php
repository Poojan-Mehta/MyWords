<?php

namespace Database\Factories;

use App\Models\Song;
use Illuminate\Database\Eloquent\Factories\Factory;

class SongFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Song::class;
    public function definition()
    {
        return [
            'song_name' => $this->faker->name,
            'song_lyrics' => $this->faker->sentence(70),
            'song_description' => $this->faker->sentence(70),
            'artist_id' => 1
        ];
    }
}
