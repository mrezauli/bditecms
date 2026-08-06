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
            'content' => fake()->sentence(),
            'question_id' => $questionId,
        ];
    }
}
