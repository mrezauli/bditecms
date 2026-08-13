<?php

namespace Database\Factories;

use App\Models\Division;
use App\Models\Site;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Site>
 */
class SiteFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->city(),
            'division_id' => Division::inRandomOrder()->value('id') ?? Division::factory(),
        ];
    }
}
