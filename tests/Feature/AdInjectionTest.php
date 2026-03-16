<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Ad;
use App\Models\UserSubscription;
use App\Models\UserSubscriptionPlan;
use App\Services\AdInjectionService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdInjectionTest extends TestCase
{
    use RefreshDatabase;

    protected $user;
    protected $freePlan;
    protected $premiumPlan;
    protected $adInjectionService;

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->adInjectionService = new AdInjectionService();
        
        // Create user
        $this->user = User::factory()->create(['is_artist' => false]);
        
        // Create subscription plans
        $this->freePlan = UserSubscriptionPlan::create([
            'title' => 'Free Listener',
            'price' => 0,
            'duration' => 30,
            'duration_months' => 1,
            'is_ads' => 0, // Show ads
        ]);
        
        $this->premiumPlan = UserSubscriptionPlan::create([
            'title' => 'Premium Listener',
            'price' => 4.99,
            'duration' => 30,
            'duration_months' => 1,
            'is_ads' => 1, // No ads
        ]);
    }

    /** @test */
    public function it_shows_ads_for_free_users()
    {
        // User has no subscription (free user)
        $shouldShowAds = $this->adInjectionService->shouldShowAds($this->user->id);
        
        $this->assertTrue($shouldShowAds);
    }

    /** @test */
    public function it_shows_ads_for_free_plan_subscribers()
    {
        // Create free subscription
        UserSubscription::create([
            'user_id' => $this->user->id,
            'usersubscription_id' => $this->freePlan->id,
            'usersubscription_date' => now(),
            'usersubscription_duration' => 30,
        ]);

        $shouldShowAds = $this->adInjectionService->shouldShowAds($this->user->id);
        
        $this->assertTrue($shouldShowAds);
    }

    /** @test */
    public function it_hides_ads_for_premium_subscribers()
    {
        // Create premium subscription
        UserSubscription::factory()->create([
            'user_id' => $this->user->id,
            'usersubscription_id' => $this->premiumPlan->id,
            'usersubscription_date' => now(),
            'usersubscription_duration' => 30,
        ]);

        $shouldShowAds = $this->adInjectionService->shouldShowAds($this->user->id);
        
        $this->assertFalse($shouldShowAds);
    }

    /** @test */
    public function it_returns_random_ad_when_available()
    {
        // Create visible ad
        $ad = Ad::create([
            'title' => 'Test Ad',
            'visibility' => 1, // Visible
            'file' => 'ads/test-ad.jpg',
            'link' => 'https://example.com',
        ]);

        $randomAd = $this->adInjectionService->getRandomAd();
        
        $this->assertNotNull($randomAd);
        $this->assertEquals($ad->id, $randomAd->id);
    }

    /** @test */
    public function it_returns_null_when_no_ads_available()
    {
        // No ads created

        $randomAd = $this->adInjectionService->getRandomAd();
        
        $this->assertNull($randomAd);
    }

    /** @test */
    public function it_only_returns_visible_ads()
    {
        // Create visible ad
        $visibleAd = Ad::create([
            'title' => 'Visible Ad',
            'visibility' => 1,
            'file' => 'ads/visible.jpg',
            'link' => 'https://example.com',
        ]);

        // Create hidden ad
        $hiddenAd = Ad::create([
            'title' => 'Hidden Ad',
            'visibility' => 0,
            'file' => 'ads/hidden.jpg',
            'link' => 'https://example.com',
        ]);

        $randomAd = $this->adInjectionService->getRandomAd();
        
        $this->assertNotNull($randomAd);
        $this->assertEquals($visibleAd->id, $randomAd->id);
        $this->assertNotEquals($hiddenAd->id, $randomAd->id);
    }

    /** @test */
    public function it_returns_ad_injection_data_for_free_users()
    {
        // Create visible ad
        $ad = Ad::create([
            'title' => 'Test Ad',
            'visibility' => 1,
            'file' => 'ads/test-ad.jpg',
            'link' => 'https://example.com',
        ]);

        $adData = $this->adInjectionService->getAdInjectionData($this->user->id);
        
        $this->assertTrue($adData['show_ads']);
        $this->assertNotNull($adData['ad']);
        $this->assertEquals($ad->id, $adData['ad']['id']);
    }

    /** @test */
    public function it_returns_no_ads_for_premium_users()
    {
        // Create premium subscription
        UserSubscription::create([
            'user_id' => $this->user->id,
            'usersubscription_id' => $this->premiumPlan->id,
            'usersubscription_date' => now(),
            'usersubscription_duration' => 30,
        ]);

        $adData = $this->adInjectionService->getAdInjectionData($this->user->id);
        
        $this->assertFalse($adData['show_ads']);
        $this->assertNull($adData['ad'] ?? null);
    }

    /** @test */
    public function it_returns_ad_timing_information()
    {
        $timing = $this->adInjectionService->getAdTiming();
        
        $this->assertArrayHasKey('next_ad_in_seconds', $timing);
        $this->assertArrayHasKey('next_ad_in_minutes', $timing);
        $this->assertArrayHasKey('min_interval', $timing);
        $this->assertArrayHasKey('max_interval', $timing);
        
        $this->assertGreaterThanOrEqual(120, $timing['next_ad_in_seconds']);
        $this->assertLessThanOrEqual(480, $timing['next_ad_in_seconds']);
    }

    /** @test */
    public function api_endpoint_returns_ad_data()
    {
        // Create visible ad
        Ad::create([
            'title' => 'Test Ad',
            'visibility' => 1,
            'file' => 'ads/test-ad.jpg',
            'link' => 'https://example.com',
        ]);

        $response = $this->actingAs($this->user)
            ->getJson('/api/ad-injection/data');

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
            ])
            ->assertJsonStructure([
                'success',
                'data' => [
                    'show_ads',
                    'ad' => [
                        'id',
                        'title',
                        'file_url',
                        'link',
                        'type',
                    ],
                    'next_ad_in_seconds',
                    'next_ad_in_minutes',
                ],
            ]);
    }

    /** @test */
    public function api_endpoint_checks_ad_eligibility()
    {
        $response = $this->actingAs($this->user)
            ->getJson('/api/ad-injection/should-show-ads');

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
            ])
            ->assertJsonStructure([
                'success',
                'show_ads',
            ]);
    }
}
