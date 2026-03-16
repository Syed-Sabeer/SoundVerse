<?php

namespace Database\Factories;

use App\Models\UserSubscription;
use App\Models\User;
use App\Models\UserSubscriptionPlan;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserSubscriptionFactory extends Factory
{
    protected $model = UserSubscription::class;

    public function definition(): array
    {
        $startDate = fake()->dateTimeBetween('-1 month', 'now');
        $duration = fake()->numberBetween(30, 365);

        return [
            'user_id' => User::factory(),
            'usersubscription_id' => UserSubscriptionPlan::factory(),
            'usersubscription_date' => $startDate,
            'usersubscription_duration' => $duration,
        ];
    }
}
