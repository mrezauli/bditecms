<?php

namespace Database\Seeders;

use App\Models\Exam;
use App\Models\Intake;
use Illuminate\Database\Seeder;

class IntakeSeeder extends Seeder
{
    public function run(): void
    {
        $ipExamId = Exam::where('acronym', 'IP')->value('id');
        $feExamId = Exam::where('acronym', 'FE')->value('id');

        $intakes = [
            ['name' => 'April 2025', 'exam_id' => $ipExamId, 'exam_date' => '2025-04-26', 'registration_starts_at' => '2025-01-01 00:00:00', 'registration_ends_at' => '2025-03-31 23:59:59', 'result_published_at' => '2025-06-15 12:00:00'],
            ['name' => 'October 2025', 'exam_id' => $ipExamId, 'exam_date' => '2025-10-25', 'registration_starts_at' => '2025-07-01 00:00:00', 'registration_ends_at' => '2025-09-30 23:59:59', 'result_published_at' => '2025-12-15 12:00:00'],
            ['name' => 'April 2026', 'exam_id' => $ipExamId, 'exam_date' => '2026-04-25', 'registration_starts_at' => '2026-01-01 00:00:00', 'registration_ends_at' => '2026-03-31 23:59:59', 'result_published_at' => null],
            ['name' => 'October 2026', 'exam_id' => $ipExamId, 'exam_date' => '2026-10-25', 'registration_starts_at' => '2026-07-01 00:00:00', 'registration_ends_at' => '2026-09-30 23:59:59', 'result_published_at' => null],

            ['name' => 'October 2023', 'exam_id' => $feExamId, 'exam_date' => '2023-10-28', 'registration_starts_at' => '2023-07-01 00:00:00', 'registration_ends_at' => '2023-09-30 23:59:59', 'result_published_at' => '2023-12-15 12:00:00'],
            ['name' => 'April 2024', 'exam_id' => $feExamId, 'exam_date' => '2024-04-27', 'registration_starts_at' => '2024-01-01 00:00:00', 'registration_ends_at' => '2024-03-31 23:59:59', 'result_published_at' => '2024-06-15 12:00:00'],
            ['name' => 'October 2025', 'exam_id' => $feExamId, 'exam_date' => '2025-10-25', 'registration_starts_at' => '2025-07-01 00:00:00', 'registration_ends_at' => '2025-09-30 23:59:59', 'result_published_at' => null],
            ['name' => 'April 2025', 'exam_id' => $feExamId, 'exam_date' => '2025-04-26', 'registration_starts_at' => '2025-01-01 00:00:00', 'registration_ends_at' => '2025-03-31 23:59:59', 'result_published_at' => null],
            ['name' => 'October 2026', 'exam_id' => $feExamId, 'exam_date' => '2026-10-25', 'registration_starts_at' => '2026-07-01 00:00:00', 'registration_ends_at' => '2026-09-30 23:59:59', 'result_published_at' => null],
            ['name' => 'April 2026', 'exam_id' => $feExamId, 'exam_date' => '2026-04-25', 'registration_starts_at' => '2026-01-01 00:00:00', 'registration_ends_at' => '2026-03-31 23:59:59', 'result_published_at' => null],
        ];

        foreach ($intakes as $intake) {
            Intake::firstOrCreate(
                ['name' => $intake['name'], 'exam_id' => $intake['exam_id']],
                $intake,
            )->setStatus('active');
        }
    }
}
