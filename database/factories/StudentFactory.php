<?php

namespace Database\Factories;

use App\Models\StudentClass;
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
    public function definition(): array
    {
        return [
            'nis' => $this->faker->unique()->numerify('########'),
            'class_id' => rand(1, 6),
            'name' => $this->faker->firstName() . " " . $this->faker->lastName(),
            'year' => $this->faker->randomElement([2023, 2024, 2025]),
        ];
    }
}
