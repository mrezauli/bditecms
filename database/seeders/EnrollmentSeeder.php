<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use App\Models\Answer;
use App\Models\Enrollment;
use App\Models\Exam;
use App\Models\Intake;
use App\Models\Site;
use App\Models\Type;
use App\Models\User;
use Illuminate\Database\Seeder;

class EnrollmentSeeder extends Seeder
{
    public function run(): void
    {
        $feExamId = Exam::where('acronym', 'FE')->value('id');
        $ipExamId = Exam::where('acronym', 'IP')->value('id');
        $users = User::where('role', RoleEnum::User->value)->currentStatus('active')->get();
        $sites = Site::all();
        $intakes = Intake::all();
        $types = Type::all();
        $bothTypeId = Type::where('name', 'FE: Both (Morning & Afternoon) Exam')->value('id');
        $answerPool = Answer::inRandomOrder()->get();

        $answerFields = [
            'first_answer_id',
            'second_answer_id',
            'third_answer_id',
            'fourth_answer_id',
            'fifth_answer_id',
            'sixth_answer_id',
            'seventh_answer_id',
            'eighth_answer_id',
            'ninth_answer_id',
        ];

        foreach ($users as $index => $user) {
            $isFe = $index % 2 === 0;
            $examId = $isFe ? $feExamId : $ipExamId;
            $intake = $intakes->isEmpty() ? null : $intakes->random();

            $enrollmentData = [
                'user_id' => $user->id,
                'intake_id' => $intake?->id,
                'exam_id' => $examId,
                'type_id' => $isFe ? $bothTypeId : $types->random()->id,
                'site_id' => $sites->random()->id,
            ];

            foreach ($answerFields as $i => $field) {
                $label = match ($i) {
                    0 => 'A', 1 => 'B', 2 => 'C', 3 => 'D',
                    default => null,
                };

                $enrollmentData[$field] = $label
                    ? ($answerPool->where('label', $label)->first()?->id ?? $answerPool->random()->id)
                    : $answerPool->random()->id;
            }

            Enrollment::firstOrCreate(
                ['user_id' => $user->id, 'exam_id' => $examId],
                $enrollmentData,
            );
        }
    }
}
