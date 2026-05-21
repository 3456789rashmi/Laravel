<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(3),
            'description' => fake()->paragraph(),
            'instructor' => fake()->name(),
            'duration_hours' => fake()->numberBetween(10, 100),
            'price' => fake()->randomFloat(2, 10, 500),
            'level' => fake()->randomElement(['Beginner', 'Intermediate', 'Advanced']),
            'status' => fake()->randomElement(['Active', 'Inactive', 'Draft']),
        ];
    }
}
