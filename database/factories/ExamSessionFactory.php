<?php

namespace Database\Factories;

use App\Models\Exam;
use App\Models\ExamSession;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ExamSession>
 */
class ExamSessionFactory extends Factory
{
    public function definition(): array
    {
        $year = fake()->numberBetween(2026, 2028);
        $month = fake()->randomElement([4, 10]);
        $day = $month === 4 ? fake()->randomElement([24, 25]) : fake()->numberBetween(20, 31);
        $examDate = "{$year}-{$month}-{$day}";

        if ($month === 4) {
            $regStart = "{$year}-01-01 00:00:00";
            $regEnd = "{$year}-03-31 23:59:59";
        } else {
            $regStart = "{$year}-07-01 00:00:00";
            $regEnd = "{$year}-09-30 23:59:59";
        }

        return [
            'exam_id' => Exam::inRandomOrder()->value('id') ?? Exam::factory(),
            'name' => $month === 4 ? "April {$year}" : "October {$year}",
            'exam_date' => $examDate,
            'registration_starts_at' => $regStart,
            'registration_ends_at' => $regEnd,
            'result_published_at' => fake()->optional(0.7)->dateTimeBetween($examDate, "{$year}-12-31"),
        ];
    }
}
