<?php

namespace Database\Factories;

use App\Models\Ad;
use Illuminate\Database\Eloquent\Factories\Factory;

class AdFactory extends Factory
{
    protected $model = Ad::class;

    public function definition(): array
    {
        return [
            'title' => fake()->words(3, true) . ' Ad',
            'file' => 'ads/' . fake()->uuid() . '.jpg',
            'link' => fake()->url(),
            'visibility' => 1, // Visible by default
        ];
    }

    public function hidden(): static
    {
        return $this->state(fn (array $attributes) => [
            'visibility' => 0,
        ]);
    }
}
