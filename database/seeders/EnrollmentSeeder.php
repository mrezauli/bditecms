<?php

namespace Database\Seeders;

use App\Models\Answer;
use App\Models\Enrollment;
use App\Models\Exam;
use App\Models\ExamSession;
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
        $users = User::all();
        $sites = Site::all();
        $feSessions = ExamSession::where('exam_id', $feExamId)->get();
        $ipSessions = ExamSession::where('exam_id', $ipExamId)->get();
        $types = Type::all();
        $bothTypeId = Type::where('name', 'Both (FE: Morning & Afternoon Exam)')->value('id');
        $answerPool = Answer::inRandomOrder()->get();

        $feSession = $feSessions->first();
        $ipSession = $ipSessions->first();

        $answerFields = [
            'first_answer_id', 'second_answer_id', 'third_answer_id',
            'fourth_answer_id', 'fifth_answer_id', 'sixth_answer_id',
            'seventh_answer_id', 'eighth_answer_id', 'ninth_answer_id',
        ];

        foreach ($users as $index => $user) {
            $isFe = $index % 2 === 0;
            $examId = $isFe ? $feExamId : $ipExamId;
            $session = $isFe ? $feSession : $ipSession;

            $enrollmentData = [
                'user_id' => $user->id,
                'exam_session_id' => $session?->id,
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
