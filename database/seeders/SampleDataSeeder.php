<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\ArtistMusic;
use App\Models\UserPlaylist;

class SampleDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a test user
        $user = User::firstOrCreate([
            'email' => 'test@example.com'
        ], [
            'name' => 'Test User',
            'password' => bcrypt('password'),
        ]);

        // Create sample music tracks
        $musicTracks = [
            [
                'name' => 'Summer Vibes',
                'driver_id' => $user->id,
                'music_file' => 'songs/summer_vibes.mp3',
                'thumbnail_image' => 'artist_thumbnails/summer_thumb.jpg',
                'listeners' => 150,
            ],
            [
                'name' => 'Night Drive',
                'driver_id' => $user->id,
                'music_file' => 'songs/night_drive.mp3',
                'thumbnail_image' => 'artist_thumbnails/night_thumb.jpg',
                'listeners' => 200,
            ],
            [
                'name' => 'Chill Beats',
                'driver_id' => $user->id,
                'music_file' => 'songs/chill_beats.mp3',
                'thumbnail_image' => 'artist_thumbnails/chill_thumb.jpg',
                'listeners' => 300,
            ],
            [
                'name' => 'Dance Floor',
                'driver_id' => $user->id,
                'music_file' => 'songs/dance_floor.mp3',
                'thumbnail_image' => 'artist_thumbnails/dance_thumb.jpg',
                'listeners' => 250,
            ],
            [
                'name' => 'Acoustic Dreams',
                'driver_id' => $user->id,
                'music_file' => 'songs/acoustic_dreams.mp3',
                'thumbnail_image' => 'artist_thumbnails/acoustic_thumb.jpg',
                'listeners' => 180,
            ],
        ];

        foreach ($musicTracks as $track) {
            ArtistMusic::firstOrCreate([
                'name' => $track['name'],
                'driver_id' => $track['driver_id']
            ], $track);
        }

        // Create sample playlists
        $playlists = [
            'My Favorites' => [1, 2, 3],
            'Workout Mix' => [2, 4, 5],
            'Chill Vibes' => [1, 3, 5],
        ];

        foreach ($playlists as $playlistName => $musicIds) {
            foreach ($musicIds as $musicId) {
                UserPlaylist::firstOrCreate([
                    'user_id' => $user->id,
                    'music_id' => $musicId,
                    'playlist_name' => $playlistName,
                ]);
            }
        }

        $this->command->info('Sample data created successfully!');
    }
}