<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UserPlaylist;
use App\Models\ArtistMusic;
use App\Models\User;

class UserPlaylistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get the first user (or create one if none exists)
        $user = User::first();
        if (!$user) {
            $user = User::create([
                'name' => 'Test User',
                'email' => 'test@example.com',
                'password' => bcrypt('password'),
            ]);
        }

        // Get some music tracks
        $musics = ArtistMusic::take(10)->get();
        
        if ($musics->count() > 0) {
            // Create sample playlists
            $playlists = [
                'My Favorites',
                'Workout Mix',
                'Chill Vibes',
                'Party Time',
                'Road Trip'
            ];

            foreach ($playlists as $playlistName) {
                // Add 2-4 random songs to each playlist
                $songsToAdd = $musics->random(rand(2, 4));
                
                foreach ($songsToAdd as $music) {
                    UserPlaylist::create([
                        'user_id' => $user->id,
                        'music_id' => $music->id,
                        'playlist_name' => $playlistName,
                    ]);
                }
            }
        }
    }
}

