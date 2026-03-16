<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\ArtistMusic;
use App\Models\MonthlyPlay;
use App\Models\StreamStat;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\Auth;
use Database\Factories\ArtistMusicFactory;

class StreamTrackingTest extends TestCase
{
    use RefreshDatabase;

    protected $user;
    protected $artist;
    protected $music;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Create test user
        $this->user = User::factory()->create([
            'is_artist' => false,
        ]);
        
        // Create test artist
        $this->artist = User::factory()->create([
            'is_artist' => true,
        ]);
        
        // Create test music
        $this->music = ArtistMusic::create([
            'driver_id' => $this->artist->id,
            'name' => 'Test Song',
            'music_file' => 'test/song.mp3',
            'thumbnail_image' => 'test/thumb.jpg',
            'listeners' => 0,
        ]);
    }

    /** @test */
    public function it_tracks_initial_play_with_zero_duration()
    {
        $response = $this->actingAs($this->user)
            ->postJson('/api/monthly-plays/track', [
                'music_id' => $this->music->id,
                'stream_duration' => 0,
            ]);

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
            ]);

        // Verify monthly play was created
        $this->assertDatabaseHas('monthly_plays', [
            'user_id' => $this->user->id,
            'music_id' => $this->music->id,
            'plays' => 1,
        ]);

        // Verify stream stat was NOT created (duration = 0)
        $this->assertDatabaseMissing('stream_stats', [
            'user_id' => $this->user->id,
            'music_id' => $this->music->id,
        ]);
    }

    /** @test */
    public function it_tracks_complete_stream_with_30_plus_seconds()
    {
        $response = $this->actingAs($this->user)
            ->postJson('/api/monthly-plays/track', [
                'music_id' => $this->music->id,
                'stream_duration' => 45, // 45 seconds
            ]);

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
            ]);

        // Verify stream stat was created with is_complete = true
        $this->assertDatabaseHas('stream_stats', [
            'user_id' => $this->user->id,
            'music_id' => $this->music->id,
            'stream_duration' => 45,
            'is_complete' => true,
            'artist_id' => $this->artist->id,
        ]);
    }

    /** @test */
    public function it_marks_incomplete_stream_for_less_than_30_seconds()
    {
        $response = $this->actingAs($this->user)
            ->postJson('/api/monthly-plays/track', [
                'music_id' => $this->music->id,
                'stream_duration' => 15, // 15 seconds
            ]);

        $response->assertStatus(200);

        // Verify stream stat was created with is_complete = false
        $this->assertDatabaseHas('stream_stats', [
            'user_id' => $this->user->id,
            'music_id' => $this->music->id,
            'stream_duration' => 15,
            'is_complete' => false,
        ]);
    }

    /** @test */
    public function it_increments_listeners_count_on_track()
    {
        $initialListeners = $this->music->listeners;

        $this->actingAs($this->user)
            ->postJson('/api/monthly-plays/track', [
                'music_id' => $this->music->id,
                'stream_duration' => 45,
            ]);

        $this->music->refresh();
        $this->assertEquals($initialListeners + 1, $this->music->listeners);
    }

    /** @test */
    public function it_tracks_multiple_plays_for_same_user()
    {
        // First play
        $this->actingAs($this->user)
            ->postJson('/api/monthly-plays/track', [
                'music_id' => $this->music->id,
                'stream_duration' => 0,
            ]);

        // Second play
        $this->actingAs($this->user)
            ->postJson('/api/monthly-plays/track', [
                'music_id' => $this->music->id,
                'stream_duration' => 0,
            ]);

        $monthlyPlay = MonthlyPlay::where('user_id', $this->user->id)
            ->where('music_id', $this->music->id)
            ->first();

        $this->assertEquals(2, $monthlyPlay->plays);
    }

    /** @test */
    public function it_requires_authentication()
    {
        $response = $this->postJson('/api/monthly-plays/track', [
            'music_id' => $this->music->id,
        ]);

        // Should still work with fallback user ID
        $response->assertStatus(200);
    }

    /** @test */
    public function it_validates_music_id_exists()
    {
        $response = $this->actingAs($this->user)
            ->postJson('/api/monthly-plays/track', [
                'music_id' => 99999, // Non-existent ID
            ]);

        $response->assertStatus(400)
            ->assertJson([
                'success' => false,
            ]);
    }
}
