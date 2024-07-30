<?php

namespace Database\Factories;

use Faker\Guesser\Name;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->name,
            'course' => fake()->country(),
            'email' => fake()->email,
            'phone' => fake()->numberBetween(1000000000, 2147483647),
            'qualification_id' => fake()->numberBetween(1,4)
        ];
    }
}
