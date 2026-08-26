<?php

namespace Database\Factories;

use App\Models\HalfPasser;
use App\Models\Intake;
use App\Models\Type;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<HalfPasser>
 */
class HalfPasserFactory extends Factory
{
    public function definition(): array
    {
        return [
            'examinee_no' => 'FE'.str_pad((string) fake()->unique()->numberBetween(1, 99), 2, '0', STR_PAD_LEFT).'-'.str_pad((string) fake()->unique()->numberBetween(1, 9999), 4, '0', STR_PAD_LEFT),
            'name' => fake()->name(),
            'type_id' => Type::factory(),
            'intake_id' => Intake::factory(),
        ];
    }
}
