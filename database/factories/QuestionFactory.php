<?php

namespace Database\Factories;

use App\Models\Question;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Question>
 */
class QuestionFactory extends Factory
{
    protected static array $questions = [
        ['label' => 'Q1', 'content' => 'What is the primary function of an operating system?'],
        ['label' => 'Q2', 'content' => 'Which network topology connects all devices to a single central cable?'],
        ['label' => 'Q3', 'content' => 'What does SQL stand for in database management?'],
        ['label' => 'Q4', 'content' => 'Which encryption algorithm is commonly used for securing web traffic?'],
        ['label' => 'Q5', 'content' => 'What is the purpose of a firewall in network security?'],
        ['label' => 'Q6', 'content' => 'Which software development methodology emphasizes iterative development?'],
        ['label' => 'Q7', 'content' => 'What is the role of a project manager in IT projects?'],
        ['label' => 'Q8', 'content' => 'What is the capital expenditure (CAPEX) model in IT budgeting?'],
        ['label' => 'Q9', 'content' => 'Which IT service management framework includes the Incident Management process?'],
    ];

    protected static int $index = -1;

    public function definition(): array
    {
        static::$index++;

        $q = static::$questions[static::$index % count(static::$questions)];

        return [
            'label' => $q['label'],
            'content' => $q['content'],
        ];
    }
}
