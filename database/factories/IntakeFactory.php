<?php

namespace Database\Factories;

use App\Models\Intake;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Intake>
 */
class IntakeFactory extends Factory
{
    public function definition(): array
    {
        $year = fake()->numberBetween(2026, 2028);
        $month = fake()->randomElement([4, 10]);
        $day = $month === 4 ? fake()->randomElement([24, 25]) : fake()->numberBetween(20, 31);
        $examDate = "{$year}-{$month}-{$day}";
        $regStartMonth = $month === 4 ? '01' : '07';
        $regEndMonth = $month === 4 ? '03' : '09';
        $regEndDay = $month === 4 ? '31' : '30';

        return [
            'name' => $month === 4 ? "April {$year}" : "October {$year}",
            'exam_date' => $examDate,
            'registration_starts_at' => "{$year}-{$regStartMonth}-01 00:00:00",
            'registration_ends_at' => "{$year}-{$regEndMonth}-{$regEndDay} 23:59:59",
            'result_published_at' => fake()->optional(0.7)->dateTimeBetween($examDate, "{$year}-12-31"),
        ];
    }
}
