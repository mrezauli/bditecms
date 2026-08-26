<?php

namespace Database\Factories;

use App\Models\Exam;
use App\Models\Type;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Type>
 */
class TypeFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->randomElement([
                'FE: Morning (AM) Exam',
                'FE: Afternoon (PM) Exam',
                'FE: Both - Morning (AM) & Afternoon (PM) Exam',
            ]),
            'exam_id' => Exam::where('acronym', 'FE')->value('id') ?? Exam::factory(),
        ];
    }
}
