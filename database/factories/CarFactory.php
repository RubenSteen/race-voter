<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Car>
 */
class CarFactory extends Factory
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
            'image' => fake()->imageUrl($width = 890, $height = 501, 'dogs'),
            'source' => fake()->url(),
            'dlc' => rand(1,2) == 1 ? null : fake()->userName(),
        ];
    }
}
