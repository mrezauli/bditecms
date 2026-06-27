<?php

namespace Database\Factories;

use App\Models\Answer;
use App\Models\Enrollment;
use App\Models\Exam;
use App\Models\Site;
use App\Models\Type;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Enrollment>
 */
class EnrollmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'exam_id' => fn (): ?int => Exam::inRandomOrder()->value('id'),
            'type_id' => fn (): ?int => Type::inRandomOrder()->value('id'),
            'site_id' => fn (): ?int => Site::inRandomOrder()->value('id'),
            'first_answer_id' => fn (): ?int => Answer::inRandomOrder()->value('id'),
            'second_answer_id' => fn (): ?int => Answer::inRandomOrder()->value('id'),
            'third_answer_id' => fn (): ?int => Answer::inRandomOrder()->value('id'),
            'fourth_answer_id' => fn (): ?int => Answer::inRandomOrder()->value('id'),
            'fifth_answer_id' => fn (): ?int => Answer::inRandomOrder()->value('id'),
            'sixth_answer_id' => fn (): ?int => Answer::inRandomOrder()->value('id'),
            'seventh_answer_id' => fn (): ?int => Answer::inRandomOrder()->value('id'),
            'eighth_answer_id' => fn (): ?int => Answer::inRandomOrder()->value('id'),
            'ninth_answer_id' => fn (): ?int => Answer::inRandomOrder()->value('id'),
        ];
    }
}
