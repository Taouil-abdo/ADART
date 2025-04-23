<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Room>
 */
class RoomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [

           'roomNumber' => fake()->numberBetween(1, 1000),
           'roomStatus' => fake()->randomElement(['available', 'occupied']),
           'capacity' => fake()->numberBetween(1,4),
           'block' => fake()->word
        ];
    }
}