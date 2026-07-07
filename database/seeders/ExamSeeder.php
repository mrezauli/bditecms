<?php

namespace Database\Seeders;

use App\Models\Exam;
use Illuminate\Database\Seeder;

class ExamSeeder extends Seeder
{
    public function run(): void
    {
        Exam::firstOrCreate(
            ['name' => 'IT Passport Exam'],
            [
                'acronym' => 'IP',
                'level' => 'Level 1',
                'details' => 'The IT Passport Exam (IP) is an entry-level certification for IT literacy. It covers 40% IT, 35% Strategy, and 25% Management topics. Open to all graduates and professionals with no prerequisites. Conducted as a single morning session of MCQ questions with no negative marking. Recognized across all 10+ ITPEC member countries.',
            ],
        )->setStatus('active');

        Exam::firstOrCreate(
            ['name' => 'Fundamental IT Engineer Exam'],
            [
                'acronym' => 'FE',
                'level' => 'Level 2',
                'details' => 'The Fundamental IT Engineer Exam (FE) is a professional-level certification for IT engineers. It covers 60% IT, 20% Strategy, and 20% Management topics. Targeted at IT professionals, graduates, and final-year CSE/IT students. Conducted as two sessions (morning and afternoon) of MCQ questions with no negative marking. Features a Half Passer Rule allowing partial credit reattempts within 1 year, and a Top Gun sponsored training program in Japan for top performers.',
            ],
        )->setStatus('active');
    }
}
