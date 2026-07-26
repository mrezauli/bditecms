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
    protected static array $types = [
        'FE: Morning Exam',
        'FE: Afternoon Exam',
        'Both (FE: Morning & Afternoon Exam)',
    ];

    protected static int $index = -1;

    public function definition(): array
    {
        static::$index++;

        return [
            'name' => static::$types[static::$index % count(static::$types)],
            'exam_id' => Exam::where('acronym', 'FE')->value('id') ?? Exam::factory(),
        ];
    }
}
