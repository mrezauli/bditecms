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
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->company(),
            'acronym' => fake()->currencyCode(),
            'website' => fake()->url(),
            'university_category_id' => fn (): ?int => UniversityCategory::inRandomOrder()->value('id'),
        ];
    }
}
