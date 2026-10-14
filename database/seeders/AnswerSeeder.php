<?php

namespace Database\Seeders;

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Database\Seeder;

class AnswerSeeder extends Seeder
{
    public function run(): void
    {
        $q1 = Question::where('label', 'Q1')->first();
        Answer::updateOrCreate(['label' => 'A', 'content' => 'Student', 'question_id' => $q1->id])->setStatus('active');
        Answer::updateOrCreate(['label' => 'B', 'content' => 'Information processing service (data entry service, database service, BPO, etc.)', 'question_id' => $q1->id])->setStatus('active');
        Answer::updateOrCreate(['label' => 'C', 'content' => 'Software service (custom software service, package software service, system integrator, etc.)', 'question_id' => $q1->id])->setStatus('active');
        Answer::updateOrCreate(['label' => 'D', 'content' => 'Manufacturing and supplying computer and peripheral', 'question_id' => $q1->id])->setStatus('active');
        Answer::updateOrCreate(['label' => 'E', 'content' => 'Telecommunication', 'question_id' => $q1->id])->setStatus('active');
        Answer::updateOrCreate(['label' => 'F', 'content' => 'Internet based service', 'question_id' => $q1->id])->setStatus('active');
        Answer::updateOrCreate(['label' => 'G', 'content' => 'Whole sale/Retail trade/Eating and drinking service', 'question_id' => $q1->id])->setStatus('active');
        Answer::updateOrCreate(['label' => 'H', 'content' => 'Finance/Securities/Insurance industry', 'question_id' => $q1->id])->setStatus('active');
        Answer::updateOrCreate(['label' => 'I', 'content' => 'Service business (other than IT related service)', 'question_id' => $q1->id])->setStatus('active');
        Answer::updateOrCreate(['label' => 'J', 'content' => 'Entertainment (game, animation, movie, etc.)', 'question_id' => $q1->id])->setStatus('active');
        Answer::updateOrCreate(['label' => 'K', 'content' => 'National Government', 'question_id' => $q1->id])->setStatus('active');
        Answer::updateOrCreate(['label' => 'L', 'content' => 'Local Government', 'question_id' => $q1->id])->setStatus('active');
        Answer::updateOrCreate(['label' => 'M', 'content' => 'Education', 'question_id' => $q1->id])->setStatus('active');
        Answer::updateOrCreate(['label' => 'N', 'content' => 'None of the above', 'question_id' => $q1->id])->setStatus('active');

        $q2 = Question::where('label', 'Q2')->first();
        Answer::updateOrCreate(['label' => 'A', 'content' => 'Student', 'question_id' => $q2->id])->setStatus('active');
        Answer::updateOrCreate(['label' => 'B', 'content' => 'System planning and design', 'question_id' => $q2->id])->setStatus('active');
        Answer::updateOrCreate(['label' => 'C', 'content' => 'Project management', 'question_id' => $q2->id])->setStatus('active');
        Answer::updateOrCreate(['label' => 'D', 'content' => 'Program development', 'question_id' => $q2->id])->setStatus('active');
        Answer::updateOrCreate(['label' => 'E', 'content' => 'Database technical support', 'question_id' => $q2->id])->setStatus('active');
        Answer::updateOrCreate(['label' => 'F', 'content' => 'Network and System management', 'question_id' => $q2->id])->setStatus('active');
        Answer::updateOrCreate(['label' => 'G', 'content' => 'Embedded system development', 'question_id' => $q2->id])->setStatus('active');
        Answer::updateOrCreate(['label' => 'H', 'content' => 'Mobile application development', 'question_id' => $q2->id])->setStatus('active');
        Answer::updateOrCreate(['label' => 'I', 'content' => 'Information security technical support', 'question_id' => $q2->id])->setStatus('active');
        Answer::updateOrCreate(['label' => 'J', 'content' => 'System audit', 'question_id' => $q2->id])->setStatus('active');
        Answer::updateOrCreate(['label' => 'K', 'content' => 'Web design, website creation', 'question_id' => $q2->id])->setStatus('active');
        Answer::updateOrCreate(['label' => 'L', 'content' => 'Game creation, animation, computer graphic design, image processing', 'question_id' => $q2->id])->setStatus('active');
        Answer::updateOrCreate(['label' => 'M', 'content' => 'Other business related to IT', 'question_id' => $q2->id])->setStatus('active');
        Answer::updateOrCreate(['label' => 'N', 'content' => 'Consultant', 'question_id' => $q2->id])->setStatus('active');
        Answer::updateOrCreate(['label' => 'O', 'content' => 'Education, training', 'question_id' => $q2->id])->setStatus('active');
        Answer::updateOrCreate(['label' => 'P', 'content' => 'None of the above', 'question_id' => $q2->id])->setStatus('active');

        $q3 = Question::where('label', 'Q3')->first();
        Answer::updateOrCreate(['label' => 'A', 'content' => 'No experience (student, etc.)', 'question_id' => $q3->id])->setStatus('active');
        Answer::updateOrCreate(['label' => 'B', 'content' => 'Less than 1 year', 'question_id' => $q3->id])->setStatus('active');
        Answer::updateOrCreate(['label' => 'C', 'content' => 'From 1 to less than 3 years', 'question_id' => $q3->id])->setStatus('active');
        Answer::updateOrCreate(['label' => 'D', 'content' => 'From 3 to less than 5 years', 'question_id' => $q3->id])->setStatus('active');
        Answer::updateOrCreate(['label' => 'E', 'content' => 'From 5 to less than 7 years', 'question_id' => $q3->id])->setStatus('active');
        Answer::updateOrCreate(['label' => 'F', 'content' => 'From 7 to less than 9 years', 'question_id' => $q3->id])->setStatus('active');
        Answer::updateOrCreate(['label' => 'G', 'content' => 'From 9 to less than 14 years', 'question_id' => $q3->id])->setStatus('active');
        Answer::updateOrCreate(['label' => 'H', 'content' => 'From 14 years to less than 19', 'question_id' => $q3->id])->setStatus('active');
        Answer::updateOrCreate(['label' => 'I', 'content' => 'Over 19 years', 'question_id' => $q3->id])->setStatus('active');

        $q4 = Question::where('label', 'Q4')->first();
        Answer::updateOrCreate(['label' => 'A', 'content' => 'Graduate school', 'question_id' => $q4->id])->setStatus('active');
        Answer::updateOrCreate(['label' => 'B', 'content' => 'University', 'question_id' => $q4->id])->setStatus('active');
        Answer::updateOrCreate(['label' => 'C', 'content' => 'Junior college', 'question_id' => $q4->id])->setStatus('active');
        Answer::updateOrCreate(['label' => 'D', 'content' => 'Technical college/Vocational school', 'question_id' => $q4->id])->setStatus('active');
        Answer::updateOrCreate(['label' => 'E', 'content' => 'High school', 'question_id' => $q4->id])->setStatus('active');
        Answer::updateOrCreate(['label' => 'F', 'content' => 'Elementary school/Junior high school', 'question_id' => $q4->id])->setStatus('active');
        Answer::updateOrCreate(['label' => 'G', 'content' => 'None of the above', 'question_id' => $q4->id])->setStatus('active');

        $q5 = Question::where('label', 'Q5')->first();
        Answer::updateOrCreate(['label' => 'A', 'content' => 'Japan', 'question_id' => $q5->id])->setStatus('active');
        Answer::updateOrCreate(['label' => 'B', 'content' => 'Korea', 'question_id' => $q5->id])->setStatus('active');
        Answer::updateOrCreate(['label' => 'C', 'content' => 'China', 'question_id' => $q5->id])->setStatus('active');
        Answer::updateOrCreate(['label' => 'D', 'content' => 'India', 'question_id' => $q5->id])->setStatus('active');
        Answer::updateOrCreate(['label' => 'E', 'content' => 'ASEAN', 'question_id' => $q5->id])->setStatus('active');
        Answer::updateOrCreate(['label' => 'F', 'content' => 'United States', 'question_id' => $q5->id])->setStatus('active');
        Answer::updateOrCreate(['label' => 'G', 'content' => 'EU', 'question_id' => $q5->id])->setStatus('active');
        Answer::updateOrCreate(['label' => 'H', 'content' => 'Domestic business only', 'question_id' => $q5->id])->setStatus('active');
        Answer::updateOrCreate(['label' => 'I', 'content' => 'No business relationship (student, etc.)', 'question_id' => $q5->id])->setStatus('active');
        Answer::updateOrCreate(['label' => 'J', 'content' => 'None of the above', 'question_id' => $q5->id])->setStatus('active');

        $q6 = Question::where('label', 'Q6')->first();
        Answer::updateOrCreate(['label' => 'A', 'content' => 'Instructed by organization, immediate superior, teacher, etc.', 'question_id' => $q6->id])->setStatus('active');
        Answer::updateOrCreate(['label' => 'B', 'content' => 'To try my ability', 'question_id' => $q6->id])->setStatus('active');
        Answer::updateOrCreate(['label' => 'C', 'content' => 'To work for companies in Japan', 'question_id' => $q6->id])->setStatus('active');
        Answer::updateOrCreate(['label' => 'D', 'content' => 'To work in IT industry', 'question_id' => $q6->id])->setStatus('active');
        Answer::updateOrCreate(['label' => 'E', 'content' => 'To take advantage in hiring', 'question_id' => $q6->id])->setStatus('active');
        Answer::updateOrCreate(['label' => 'F', 'content' => 'To get promotion', 'question_id' => $q6->id])->setStatus('active');
        Answer::updateOrCreate(['label' => 'G', 'content' => 'To get bonus', 'question_id' => $q6->id])->setStatus('active');
        Answer::updateOrCreate(['label' => 'H', 'content' => 'None of the above', 'question_id' => $q6->id])->setStatus('active');

        $q7 = Question::where('label', 'Q7')->first();
        Answer::updateOrCreate(['label' => 'A', 'content' => 'Yes', 'question_id' => $q7->id])->setStatus('active');
        Answer::updateOrCreate(['label' => 'B', 'content' => 'No', 'question_id' => $q7->id])->setStatus('active');
        Answer::updateOrCreate(['label' => 'C', 'content' => 'I already work in a Japanese company in my country', 'question_id' => $q7->id])->setStatus('active');

        $q8 = Question::where('label', 'Q8')->first();
        Answer::updateOrCreate(['label' => 'A', 'content' => 'IT Exam Preparation Book (Distributed at the seminar, school, or The Exam implementing body)', 'question_id' => $q8->id])->setStatus('active');
        Answer::updateOrCreate(['label' => 'B', 'content' => 'IT Exam Preparation Book (Purchased)', 'question_id' => $q8->id])->setStatus('active');
        Answer::updateOrCreate(['label' => 'C', 'content' => 'Past questions of this Exam', 'question_id' => $q8->id])->setStatus('active');
        Answer::updateOrCreate(['label' => 'D', 'content' => 'IT related learning materials (reference book, technical book, etc.)', 'question_id' => $q8->id])->setStatus('active');
        Answer::updateOrCreate(['label' => 'E', 'content' => 'Other Exam\'s textbook', 'question_id' => $q8->id])->setStatus('active');
        Answer::updateOrCreate(['label' => 'F', 'content' => 'None of the above', 'question_id' => $q8->id])->setStatus('active');

        $q9 = Question::where('label', 'Q9')->first();
        Answer::updateOrCreate(['label' => 'A', 'content' => 'Seminar', 'question_id' => $q9->id])->setStatus('active');
        Answer::updateOrCreate(['label' => 'B', 'content' => 'Information from friends or colleagues', 'question_id' => $q9->id])->setStatus('active');
        Answer::updateOrCreate(['label' => 'C', 'content' => 'Advice from teachers or supervisors', 'question_id' => $q9->id])->setStatus('active');
        Answer::updateOrCreate(['label' => 'D', 'content' => 'Website of the Exam implementing body', 'question_id' => $q9->id])->setStatus('active');
        Answer::updateOrCreate(['label' => 'E', 'content' => 'Search site, such as Google, Yahoo, etc.', 'question_id' => $q9->id])->setStatus('active');
        Answer::updateOrCreate(['label' => 'F', 'content' => 'Advertisement', 'question_id' => $q9->id])->setStatus('active');
        Answer::updateOrCreate(['label' => 'G', 'content' => 'None of the above', 'question_id' => $q9->id])->setStatus('active');
    }
}
