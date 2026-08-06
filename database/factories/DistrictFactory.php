<?php

namespace Database\Factories;

use App\Models\District;
use App\Models\Division;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<District>
 */
class DistrictFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->city(),
            'name_bn' => fake()->word(),
            'division_id' => Division::inRandomOrder()->value('id') ?? Division::factory(),
        ];
    }
}
