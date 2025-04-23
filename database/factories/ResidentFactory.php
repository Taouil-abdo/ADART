<?php

namespace Database\Factories;

use App\Models\Room;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Resident>
 */
class ResidentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
        'fullname' => $this->faker->name(),
        'email' => $this->faker->unique()->safeEmail(),
        'status' => $this->faker->randomElement(['active', 'inactive','suspended']),
        'profile_img' => $this->faker->imageUrl(200, 200, 'people'),
        'birthday' => $this->faker->date(),
        'address' => $this->faker->address(),
        'age' => $this->faker->numberBetween(18, 80),
        'gender' => $this->faker->randomElement(['boy', 'girl']),
        'school_level' => $this->faker->randomElement(['primary', 'secondary', 'tertiary']),
        'date_joined' => $this->faker->dateTimeBetween('-5 years', 'now'),
        'date_detached' => $this->faker->optional()->dateTimeBetween('now', '+5 years'),
        'urgent_contact' => $this->faker->phoneNumber(),
        'school' => $this->faker->company(),
        'health_condition' => $this->faker->randomElement(['healthy', 'minor issues', 'critical']),
        'disease_type' => $this->faker->optional()->word(),
        'room_id' => Room::factory(),
        ];
    }
}
