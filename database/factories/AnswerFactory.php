<?php

namespace Database\Factories;

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Answer>
 */
class AnswerFactory extends Factory
{
    protected static array $optionLabels = ['A', 'B', 'C', 'D'];

    protected static int $globalIndex = -1;

    public function definition(): array
    {
        static::$globalIndex++;

        $questionId = Question::inRandomOrder()->value('id') ?? Question::factory();
        $optionIndex = static::$globalIndex % 4;

        return [
            'label' => static::$optionLabels[$optionIndex],
            'content' => fake()->randomElement([
                'Process management and memory allocation',
                'Star topology',
                'Structured Query Language',
                'SSL/TLS',
                'To monitor and control incoming and outgoing network traffic',
                'Agile methodology',
                'To plan, execute, and close projects',
                'One-time investment in physical assets',
                'ITIL (Information Technology Infrastructure Library)',
                'To manage hardware resources',
                'Bus topology',
                'Simple Query Language',
                'AES',
                'To block all external access',
                'Waterfall methodology',
                'To write code for the team',
                'Recurring monthly expenses',
                'COBIT',
                'Kernel and user space management',
                'Ring topology',
                'Standard Query Language',
                'RSA',
                'To encrypt data at rest',
                'DevOps methodology',
                'To conduct performance reviews',
                'Annual operational budget',
                'ISO 27001',
                'Device driver management',
                'Mesh topology',
                'Sequential Query Language',
                'DES',
                'To authenticate users',
                'Spiral methodology',
                'To design system architecture',
                'Long-term depreciation of assets',
                'TOGAF',
            ]),
            'question_id' => $questionId,
        ];
    }
}
