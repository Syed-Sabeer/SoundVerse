<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ArtistMusic;
use App\Models\User;

class MusicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a test user if it doesn't exist
        $user = User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test Artist',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
            ]
        );

        // Sample music data
        $musicData = [
            [
                'name' => 'Blinding Lights',
                'driver_id' => $user->id,
                'music_file' => 'songs/blinding_lights.mp3',
                'thumbnail_image' => 'thumbnails/blinding_lights.jpg',
                'listeners' => 1500000,
            ],
            [
                'name' => 'Watermelon Sugar',
                'driver_id' => $user->id,
                'music_file' => 'songs/watermelon_sugar.mp3',
                'thumbnail_image' => 'thumbnails/watermelon_sugar.jpg',
                'listeners' => 1200000,
            ],
            [
                'name' => 'Good 4 U',
                'driver_id' => $user->id,
                'music_file' => 'songs/good_4_u.mp3',
                'thumbnail_image' => 'thumbnails/good_4_u.jpg',
                'listeners' => 1800000,
            ],
            [
                'name' => 'Levitating',
                'driver_id' => $user->id,
                'music_file' => 'songs/levitating.mp3',
                'thumbnail_image' => 'thumbnails/levitating.jpg',
                'listeners' => 2000000,
            ],
            [
                'name' => 'Stay',
                'driver_id' => $user->id,
                'music_file' => 'songs/stay.mp3',
                'thumbnail_image' => 'thumbnails/stay.jpg',
                'listeners' => 1600000,
            ],
            [
                'name' => 'Industry Baby',
                'driver_id' => $user->id,
                'music_file' => 'songs/industry_baby.mp3',
                'thumbnail_image' => 'thumbnails/industry_baby.jpg',
                'listeners' => 1400000,
            ],
            [
                'name' => 'Heat Waves',
                'driver_id' => $user->id,
                'music_file' => 'songs/heat_waves.mp3',
                'thumbnail_image' => 'thumbnails/heat_waves.jpg',
                'listeners' => 1700000,
            ],
            [
                'name' => 'Bad Habits',
                'driver_id' => $user->id,
                'music_file' => 'songs/bad_habits.mp3',
                'thumbnail_image' => 'thumbnails/bad_habits.jpg',
                'listeners' => 1900000,
            ],
            [
                'name' => 'Dance Monkey',
                'driver_id' => $user->id,
                'music_file' => 'songs/dance_monkey.mp3',
                'thumbnail_image' => 'thumbnails/dance_monkey.jpg',
                'listeners' => 2200000,
            ],
            [
                'name' => 'Shape of You',
                'driver_id' => $user->id,
                'music_file' => 'songs/shape_of_you.mp3',
                'thumbnail_image' => 'thumbnails/shape_of_you.jpg',
                'listeners' => 2500000,
            ],
        ];

        foreach ($musicData as $music) {
            ArtistMusic::create($music);
        }
    }
}