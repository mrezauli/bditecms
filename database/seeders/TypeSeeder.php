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

        Type::firstOrCreate(['name' => 'Both', 'exam_id' => $exams['IP']])->setStatus('active');
        Type::firstOrCreate(['name' => 'Morning Exam', 'exam_id' => $exams['FE']])->setStatus('active');
        Type::firstOrCreate(['name' => 'Afternoon Exam', 'exam_id' => $exams['FE']])->setStatus('active');
        Type::firstOrCreate(['name' => 'Both', 'exam_id' => $exams['FE']])->setStatus('active');
    }
}
