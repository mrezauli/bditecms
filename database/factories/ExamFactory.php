<?php

namespace Database\Factories;

use App\Models\Exam;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Exam>
 */
class ExamFactory extends Factory
{
    public function definition(): array
    {
        $acronym = strtoupper(fake()->bothify('??'));
        $isIp = $acronym === 'IP';

        return [
            'name' => fake()->words(3, true).' Exam',
            'acronym' => $acronym,
            'level' => 'Level '.fake()->numberBetween(1, 5),
            'details' => fake()->paragraph(),
            'ip_fee' => $isIp ? fake()->randomFloat(2, 100, 1000) : null,
            'fe_full_fee' => $isIp ? null : fake()->randomFloat(2, 500, 2000),
            'fe_half_passer_fee' => $isIp ? null : fake()->randomFloat(2, 200, 1000),
        ];
    }
}
