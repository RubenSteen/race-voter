<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Suggest>
 */
class SuggestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => \App\Models\User::all()->random()->id,
            'car_id' => \App\Models\Car::all()->random()->id,
            'track_id' => \App\Models\Track::all()->random()->id,
        ];
    }
}
