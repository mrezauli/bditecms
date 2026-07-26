<?php

namespace Database\Seeders;

use App\Models\Exam;
use App\Models\ExamSession;
use Illuminate\Database\Seeder;

class ExamSessionSeeder extends Seeder
{
    public function run(): void
    {
        $exams = Exam::pluck('id', 'acronym');

        $sessions = [
            ['exam_id' => $exams['IP'], 'name' => 'April 2025', 'exam_date' => '2025-04-26', 'registration_starts_at' => '2025-01-01 00:00:00', 'registration_ends_at' => '2025-03-31 23:59:59', 'result_published_at' => '2025-06-15 12:00:00'],
            ['exam_id' => $exams['IP'], 'name' => 'October 2025', 'exam_date' => '2025-10-25', 'registration_starts_at' => '2025-07-01 00:00:00', 'registration_ends_at' => '2025-09-30 23:59:59', 'result_published_at' => '2025-12-15 12:00:00'],
            ['exam_id' => $exams['IP'], 'name' => 'April 2026', 'exam_date' => '2026-04-25', 'registration_starts_at' => '2026-01-01 00:00:00', 'registration_ends_at' => '2026-03-31 23:59:59', 'result_published_at' => null],
            ['exam_id' => $exams['IP'], 'name' => 'October 2026', 'exam_date' => '2026-10-25', 'registration_starts_at' => '2026-07-01 00:00:00', 'registration_ends_at' => '2026-09-30 23:59:59', 'result_published_at' => null],
            ['exam_id' => $exams['FE'], 'name' => 'April 2025', 'exam_date' => '2025-04-26', 'registration_starts_at' => '2025-01-01 00:00:00', 'registration_ends_at' => '2025-03-31 23:59:59', 'result_published_at' => '2025-06-15 12:00:00'],
            ['exam_id' => $exams['FE'], 'name' => 'October 2025', 'exam_date' => '2025-10-25', 'registration_starts_at' => '2025-07-01 00:00:00', 'registration_ends_at' => '2025-09-30 23:59:59', 'result_published_at' => '2025-12-15 12:00:00'],
            ['exam_id' => $exams['FE'], 'name' => 'April 2026', 'exam_date' => '2026-04-25', 'registration_starts_at' => '2026-01-01 00:00:00', 'registration_ends_at' => '2026-03-31 23:59:59', 'result_published_at' => null],
            ['exam_id' => $exams['FE'], 'name' => 'October 2026', 'exam_date' => '2026-10-25', 'registration_starts_at' => '2026-07-01 00:00:00', 'registration_ends_at' => '2026-09-30 23:59:59', 'result_published_at' => null],
        ];

        foreach ($sessions as $session) {
            ExamSession::firstOrCreate(
                ['exam_id' => $session['exam_id'], 'name' => $session['name']],
                $session,
            )->setStatus('active');
        }
    }
}
