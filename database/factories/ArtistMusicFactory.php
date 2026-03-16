<?php

namespace Database\Factories;

use App\Models\ArtistMusic;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArtistMusicFactory extends Factory
{
    protected $model = ArtistMusic::class;

    public function definition(): array
    {
        return [
            'driver_id' => User::factory(),
            'name' => fake()->words(3, true) . ' Song',
            'music_file' => 'artist_music/' . fake()->uuid() . '.mp3',
            'video_file' => null,
            'thumbnail_image' => 'artist_thumbnails/' . fake()->uuid() . '.jpg',
            'listeners' => fake()->numberBetween(0, 10000),
            'is_featured' => false,
            'isrc_code' => null,
        ];
    }
}
