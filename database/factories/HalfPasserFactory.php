<?php

namespace Database\Factories;

use App\Models\HalfPasser;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<HalfPasser>
 */
class HalfPasserFactory extends Factory
{
    public function definition(): array
    {
        $examType = fake()->randomElement(['Morning Exam', 'Afternoon Exam']);

        return [
            'examinee_no' => 'FE'.str_pad((string) fake()->unique()->numberBetween(1, 99), 2, '0', STR_PAD_LEFT).'-'.str_pad((string) fake()->unique()->numberBetween(1, 9999), 4, '0', STR_PAD_LEFT),
            'name' => fake()->name(),
            'exam_type' => $examType,
            'remarks' => fake()->optional(0.3)->sentence(),
        ];
    }
}
