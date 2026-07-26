<?php

namespace Database\Factories;

use App\Models\UniversityCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<UniversityCategory>
 */
class UniversityCategoryFactory extends Factory
{
    protected static array $categories = [
        'Public University',
        'Private University',
        'National University',
        'Science & Technology University',
        'Engineering University',
        'Medical University',
        'Agricultural University',
        'International University',
    ];

    protected static int $index = -1;

    public function definition(): array
    {
        static::$index++;

        return [
            'name' => static::$categories[static::$index % count(static::$categories)],
        ];
    }
}
