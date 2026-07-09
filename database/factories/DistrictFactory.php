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
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->city(),
            'name_bn' => fake()->word(),
            'division_id' => fn (): ?int => Division::inRandomOrder()->value('id'),
        ];
    }
}
