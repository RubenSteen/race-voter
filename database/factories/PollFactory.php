<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Poll>
 */
class PollFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->userName(),
            'open_at' => \Carbon\Carbon::now(),
            'close_at' => \Carbon\Carbon::now()->addDays(1),
            'user_id' => \App\Models\User::all()->random()->id,
        ];
    }
}
