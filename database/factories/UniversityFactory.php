<?php

namespace Database\Factories;

use App\Models\University;
use App\Models\UniversityCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<University>
 */
class UniversityFactory extends Factory
{
    public function definition(): array
    {
        $acronym = strtoupper(fake()->bothify('???'));
        $name = fake()->words(3, true).' University';

        return [
            'name' => $name,
            'acronym' => $acronym,
            'website' => fake()->url(),
            'university_category_id' => UniversityCategory::inRandomOrder()->value('id') ?? UniversityCategory::factory(),
        ];
    }
}
