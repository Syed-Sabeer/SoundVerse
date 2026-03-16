<?php

namespace Database\Factories;

use App\Models\UserSubscriptionPlan;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserSubscriptionPlanFactory extends Factory
{
    protected $model = UserSubscriptionPlan::class;

    public function definition(): array
    {
        return [
            'title' => fake()->words(2, true) . ' Plan',
            'price' => fake()->randomFloat(2, 0, 20),
            'duration' => 30,
            'duration_months' => 1,
            'is_unlimitedstreaming' => true,
            'is_ads' => 0, // Show ads by default
            'is_offline' => false,
            'offline_download_limit' => 0,
            'is_highquality' => false,
            'is_unlimitedplaylist' => false,
            'playlist_limit' => 3,
            'is_exclusivecontent' => false,
            'is_prioritysupport' => false,
            'is_family' => false,
            'family_limit' => 0,
            'is_parentalcontrol' => false,
            'is_tip_artists' => false,
            'is_personalized_recommendations' => false,
            'is_supporter_badge' => false,
            'is_trending_access' => true,
        ];
    }
}
