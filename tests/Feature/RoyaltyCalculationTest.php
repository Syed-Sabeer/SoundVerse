<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\ArtistMusic;
use App\Models\StreamStat;
use App\Models\PlatformRevenueTracking;
use App\Models\ArtistEarning;
use App\Models\ArtistWallet;
use App\Models\RoyaltyCalculation;
use App\Services\RoyaltyCalculationService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Carbon\Carbon;

class RoyaltyCalculationTest extends TestCase
{
    use RefreshDatabase;

    protected $artist1;
    protected $artist2;
    protected $music1;
    protected $music2;
    protected $royaltyService;

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->royaltyService = new RoyaltyCalculationService();
        
        // Create artists
        $this->artist1 = User::factory()->create(['is_artist' => true]);
        $this->artist2 = User::factory()->create(['is_artist' => true]);
        
        // Create music tracks
        $this->music1 = ArtistMusic::create([
            'driver_id' => $this->artist1->id,
            'name' => 'Song 1',
            'music_file' => 'test/song1.mp3',
            'thumbnail_image' => 'test/thumb1.jpg',
            'listeners' => 0,
        ]);
        
        $this->music2 = ArtistMusic::create([
            'driver_id' => $this->artist2->id,
            'name' => 'Song 2',
            'music_file' => 'test/song2.mp3',
            'thumbnail_image' => 'test/thumb2.jpg',
            'listeners' => 0,
        ]);
        
        // Create wallets
        ArtistWallet::getOrCreateForArtist($this->artist1->id);
        ArtistWallet::getOrCreateForArtist($this->artist2->id);
    }

    /** @test */
    public function it_calculates_royalties_based_on_stream_proportion()
    {
        $month = now()->month;
        $year = now()->year;
        $platformRevenue = 1000.00; // $1000 total platform revenue

        // Create platform revenue tracking
        PlatformRevenueTracking::create([
            'period_month' => $month,
            'period_year' => $year,
            'total_platform_revenue' => $platformRevenue,
            'status' => 'confirmed',
        ]);

        // Create stream stats
        // Artist 1: 10,000 streams
        for ($i = 0; $i < 10000; $i++) {
            StreamStat::create([
                'music_id' => $this->music1->id,
                'artist_id' => $this->artist1->id,
                'user_id' => 1,
                'stream_duration' => 45,
                'is_complete' => true,
                'streamed_at' => Carbon::create($year, $month, 1)->addDays(rand(0, 27)),
            ]);
        }

        // Artist 2: 5,000 streams
        for ($i = 0; $i < 5000; $i++) {
            StreamStat::create([
                'music_id' => $this->music2->id,
                'artist_id' => $this->artist2->id,
                'user_id' => 1,
                'stream_duration' => 45,
                'is_complete' => true,
                'streamed_at' => Carbon::create($year, $month, 1)->addDays(rand(0, 27)),
            ]);
        }

        // Total: 15,000 streams
        // Artist 1 share: 10,000 / 15,000 = 66.67%
        // Artist 2 share: 5,000 / 15,000 = 33.33%

        $calculations = $this->royaltyService->calculateRoyaltiesForPeriod($month, $year);

        // Verify calculations were created
        $this->assertCount(2, $calculations);

        // Verify Artist 1 earnings
        $artist1Calculation = RoyaltyCalculation::where('artist_id', $this->artist1->id)
            ->where('calculation_period', Carbon::create($year, $month, 1)->format('Y-m-d'))
            ->first();

        $this->assertNotNull($artist1Calculation);
        $this->assertEquals(10000, $artist1Calculation->total_streams);
        
        // Expected: (10000 / 15000) * 1000 = $666.67 gross
        // Platform fee (20%): $133.33
        // Net: $533.34
        $expectedGross = (10000 / 15000) * 1000;
        $expectedPlatformFee = $expectedGross * 0.20;
        $expectedNet = $expectedGross - $expectedPlatformFee;

        $this->assertEqualsWithDelta($expectedGross, $artist1Calculation->total_gross_revenue, 0.01);
        $this->assertEqualsWithDelta($expectedPlatformFee, $artist1Calculation->platform_fee_amount, 0.01);
        $this->assertEqualsWithDelta($expectedNet, $artist1Calculation->artist_royalty_amount, 0.01);

        // Verify wallet was updated
        $wallet1 = ArtistWallet::where('artist_id', $this->artist1->id)->first();
        $this->assertEqualsWithDelta($expectedNet, $wallet1->available_balance, 0.01);
        $this->assertEqualsWithDelta($expectedNet, $wallet1->total_earned, 0.01);
    }

    /** @test */
    public function it_applies_20_percent_platform_fee()
    {
        $month = now()->month;
        $year = now()->year;
        $platformRevenue = 1000.00;

        PlatformRevenueTracking::create([
            'period_month' => $month,
            'period_year' => $year,
            'total_platform_revenue' => $platformRevenue,
            'status' => 'confirmed',
        ]);

        // Create 1000 streams for artist 1
        for ($i = 0; $i < 1000; $i++) {
            StreamStat::create([
                'music_id' => $this->music1->id,
                'artist_id' => $this->artist1->id,
                'user_id' => 1,
                'stream_duration' => 45,
                'is_complete' => true,
                'streamed_at' => Carbon::create($year, $month, 1)->addDays(rand(0, 27)),
            ]);
        }

        $this->royaltyService->calculateRoyaltiesForPeriod($month, $year);

        $calculation = RoyaltyCalculation::where('artist_id', $this->artist1->id)->first();
        
        // Platform fee should be 20%
        $this->assertEquals(20.0, $calculation->platform_fee_percentage);
        $this->assertEquals(80.0, $calculation->royalty_percentage);
        
        // Verify fee calculation
        $expectedFee = $calculation->total_gross_revenue * 0.20;
        $this->assertEqualsWithDelta($expectedFee, $calculation->platform_fee_amount, 0.01);
    }

    /** @test */
    public function it_only_counts_complete_streams()
    {
        $month = now()->month;
        $year = now()->year;
        $platformRevenue = 1000.00;

        PlatformRevenueTracking::create([
            'period_month' => $month,
            'period_year' => $year,
            'total_platform_revenue' => $platformRevenue,
            'status' => 'confirmed',
        ]);

        // Create 100 complete streams (30+ seconds)
        for ($i = 0; $i < 100; $i++) {
            StreamStat::create([
                'music_id' => $this->music1->id,
                'artist_id' => $this->artist1->id,
                'user_id' => 1,
                'stream_duration' => 45,
                'is_complete' => true,
                'streamed_at' => Carbon::create($year, $month, 1)->addDays(rand(0, 27)),
            ]);
        }

        // Create 50 incomplete streams (< 30 seconds)
        for ($i = 0; $i < 50; $i++) {
            StreamStat::create([
                'music_id' => $this->music1->id,
                'artist_id' => $this->artist1->id,
                'user_id' => 1,
                'stream_duration' => 15,
                'is_complete' => false,
                'streamed_at' => Carbon::create($year, $month, 1)->addDays(rand(0, 27)),
            ]);
        }

        $this->royaltyService->calculateRoyaltiesForPeriod($month, $year);

        $calculation = RoyaltyCalculation::where('artist_id', $this->artist1->id)->first();
        
        // Should only count 100 complete streams
        $this->assertEquals(100, $calculation->total_streams);
    }

    /** @test */
    public function it_creates_artist_earnings_records()
    {
        $month = now()->month;
        $year = now()->year;
        $platformRevenue = 1000.00;

        PlatformRevenueTracking::create([
            'period_month' => $month,
            'period_year' => $year,
            'total_platform_revenue' => $platformRevenue,
            'status' => 'confirmed',
        ]);

        // Create streams
        for ($i = 0; $i < 1000; $i++) {
            StreamStat::create([
                'music_id' => $this->music1->id,
                'artist_id' => $this->artist1->id,
                'user_id' => 1,
                'stream_duration' => 45,
                'is_complete' => true,
                'streamed_at' => Carbon::create($year, $month, 1)->addDays(rand(0, 27)),
            ]);
        }

        $this->royaltyService->calculateRoyaltiesForPeriod($month, $year);

        // Verify earnings records were created
        $earnings = ArtistEarning::where('artist_id', $this->artist1->id)
            ->where('music_id', $this->music1->id)
            ->get();

        $this->assertGreaterThan(0, $earnings->count());
        
        $earning = $earnings->first();
        $this->assertEquals('stream', $earning->earnings_type);
        $this->assertEquals('processed', $earning->status);
        $this->assertGreaterThan(0, $earning->gross_amount);
        $this->assertGreaterThan(0, $earning->platform_fee);
        $this->assertGreaterThan(0, $earning->net_amount);
    }

    /** @test */
    public function it_handles_zero_streams_gracefully()
    {
        $month = now()->month;
        $year = now()->year;
        $platformRevenue = 1000.00;

        PlatformRevenueTracking::create([
            'period_month' => $month,
            'period_year' => $year,
            'total_platform_revenue' => $platformRevenue,
            'status' => 'confirmed',
        ]);

        // No streams created

        $calculations = $this->royaltyService->calculateRoyaltiesForPeriod($month, $year);

        // Should return empty array
        $this->assertIsArray($calculations);
        $this->assertEmpty($calculations);
    }
}
