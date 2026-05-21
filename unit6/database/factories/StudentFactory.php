<?php

namespace Database\Factories;

use App\Models\student;
use Illuminate\Database\Eloquent\Factories\Factory;
use carbon\carbon;
/**
 * @extends Factory<Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email'=>$this->faker->safeEmail(),
            'subject'=>$this->faker->randomElement(
                [
                    'maths','cse','punjabi','ece','english','hindi'
                ]
            ),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
    }
}

//facker function used along with facory
