<?php

namespace Database\Seeders;

use App\Models\Question;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    public function run(): void
    {
        Question::firstOrCreate(['label' => 'Q1', 'content' => 'What type of industry are you working in?'])->setStatus('active');
        Question::firstOrCreate(['label' => 'Q2', 'content' => 'What kind of work are you engaging in?'])->setStatus('active');
        Question::firstOrCreate(['label' => 'Q3', 'content' => 'How long is your work experience?'])->setStatus('active');
        Question::firstOrCreate(['label' => 'Q4', 'content' => 'What is your last graduated school? (If you are a student, choose your current school type)'])->setStatus('active');
        Question::firstOrCreate(['label' => 'Q5', 'content' => 'What is the nationality of your client company which you have a deal with most? Or what is the nationality of your supervisor/colleague whom you are working with closely in your company for foreign business?'])->setStatus('active');
        Question::firstOrCreate(['label' => 'Q6', 'content' => 'What is your motivation for your application to this examination?'])->setStatus('active');
        Question::firstOrCreate(['label' => 'Q7', 'content' => 'Are you interested in working Japanese companies in your country?'])->setStatus('active');
        Question::firstOrCreate(['label' => 'Q8', 'content' => 'What kind of materials did you use to prepare for the exam?'])->setStatus('active');
        Question::firstOrCreate(['label' => 'Q9', 'content' => 'How did you know this Examination?'])->setStatus('active');
    }
}
