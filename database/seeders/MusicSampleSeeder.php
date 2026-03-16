<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ArtistMusic;
use App\Models\User;

class MusicSampleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a sample user if it doesn't exist
        $user = User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'username' => 'testuser',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
            ]
        );

        // Create sample music records
        $songs = [
            [
                'name' => 'Midnight City',
                'driver_id' => $user->id,
                'music_file' => 'songs/sample1.mp3',
                'thumbnail_image' => 'artist_thumbnails/sample1.jpg',
                'listeners' => 1250,
            ],
            [
                'name' => 'Perfect',
                'driver_id' => $user->id,
                'music_file' => 'songs/sample2.mp3',
                'thumbnail_image' => 'artist_thumbnails/sample2.jpg',
                'listeners' => 2100,
            ],
            [
                'name' => 'Shape of You',
                'driver_id' => $user->id,
                'music_file' => 'songs/sample1.mp3',
                'thumbnail_image' => 'artist_thumbnails/sample1.jpg',
                'listeners' => 3500,
            ],
            [
                'name' => 'Blinding Lights',
                'driver_id' => $user->id,
                'music_file' => 'songs/sample2.mp3',
                'thumbnail_image' => 'artist_thumbnails/sample2.jpg',
                'listeners' => 2800,
            ],
            [
                'name' => 'Levitating',
                'driver_id' => $user->id,
                'music_file' => 'songs/sample1.mp3',
                'thumbnail_image' => 'artist_thumbnails/sample1.jpg',
                'listeners' => 1900,
            ],
        ];

        foreach ($songs as $song) {
            ArtistMusic::firstOrCreate(
                ['name' => $song['name'], 'driver_id' => $song['driver_id']],
                $song
            );
        }

        $this->command->info('Sample music data created successfully!');
    }
}
