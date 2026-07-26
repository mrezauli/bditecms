<?php

namespace Database\Factories;

use App\Models\Answer;
use App\Models\Enrollment;
use App\Models\Exam;
use App\Models\ExamSession;
use App\Models\Site;
use App\Models\Type;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Enrollment>
 */
class EnrollmentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'exam_session_id' => ExamSession::inRandomOrder()->value('id') ?? ExamSession::factory(),
            'exam_id' => Exam::inRandomOrder()->value('id') ?? Exam::factory(),
            'type_id' => Type::inRandomOrder()->value('id') ?? Type::factory(),
            'site_id' => Site::inRandomOrder()->value('id') ?? Site::factory(),
            'first_answer_id' => Answer::inRandomOrder()->value('id') ?? Answer::factory(),
            'second_answer_id' => Answer::inRandomOrder()->value('id') ?? Answer::factory(),
            'third_answer_id' => Answer::inRandomOrder()->value('id') ?? Answer::factory(),
            'fourth_answer_id' => Answer::inRandomOrder()->value('id') ?? Answer::factory(),
            'fifth_answer_id' => Answer::inRandomOrder()->value('id') ?? Answer::factory(),
            'sixth_answer_id' => Answer::inRandomOrder()->value('id') ?? Answer::factory(),
            'seventh_answer_id' => Answer::inRandomOrder()->value('id') ?? Answer::factory(),
            'eighth_answer_id' => Answer::inRandomOrder()->value('id') ?? Answer::factory(),
            'ninth_answer_id' => Answer::inRandomOrder()->value('id') ?? Answer::factory(),
        ];
    }
}
