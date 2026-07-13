<?php

namespace Database\Seeders;

use App\Models\Exam;
use App\Models\Type;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    public function run(): void
    {
        $exams = Exam::pluck('id', 'acronym');

        Type::firstOrCreate(['name' => 'FE: Morning Exam', 'exam_id' => $exams['FE']])->setStatus('active');
        Type::firstOrCreate(['name' => 'FE: Afternoon Exam', 'exam_id' => $exams['FE']])->setStatus('active');
        Type::firstOrCreate(['name' => 'Both (FE: Morning & Afternoon Exam)', 'exam_id' => $exams['FE']])->setStatus('active');
    }
}
