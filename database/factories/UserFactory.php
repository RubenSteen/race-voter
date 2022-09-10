<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'id' => rand(1, 999999),
            'name' => fake()->userName(),
            'nickname' => fake()->userName(),
            'remember_token' => Str::random(10),
            'token' => Str::random(10),
            'token_expires_at' => \Carbon\Carbon::now()->addDays(7),
            'refresh_token' => Str::random(10),
        ];
    }
}
