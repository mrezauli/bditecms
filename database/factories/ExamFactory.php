<?php

namespace Database\Factories;

use App\Models\Exam;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Exam>
 */
class ExamFactory extends Factory
{
    protected static array $exams = [
        ['name' => 'IT Passport Exam', 'acronym' => 'IP', 'level' => 'Level 1'],
        ['name' => 'Fundamental IT Engineer Exam', 'acronym' => 'FE', 'level' => 'Level 2'],
    ];

    protected static int $index = -1;

    public function definition(): array
    {
        static::$index++;

        $exam = static::$exams[static::$index % count(static::$exams)];

        $isIp = $exam['acronym'] === 'IP';

        return [
            'name' => $exam['name'],
            'acronym' => $exam['acronym'],
            'level' => $exam['level'],
            'details' => $isIp
                ? 'The IT Passport Exam (IP) is an entry-level certification for IT literacy. It covers 40% IT, 35% Strategy, and 25% Management topics. Open to all graduates and professionals with no prerequisites. Conducted as a single morning session of MCQ questions with no negative marking. Recognized across all 10+ ITPEC member countries.'
                : 'The Fundamental IT Engineer Exam (FE) is a professional-level certification for IT engineers. It covers 60% IT, 20% Strategy, and 20% Management topics. Targeted at IT professionals, graduates, and final-year CSE/IT students. Conducted as two sessions (morning and afternoon) of MCQ questions with no negative marking. Features a Half Passer Rule allowing partial credit reattempts within 1 year.',
            'ip_fee' => $isIp ? 500.00 : null,
            'fe_full_fee' => $isIp ? null : 1000.00,
            'fe_half_passer_fee' => $isIp ? null : 500.00,
        ];
    }
}
