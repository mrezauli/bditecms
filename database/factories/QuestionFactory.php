<?php

namespace Database\Factories;

use App\Models\Question;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Question>
 */
class QuestionFactory extends Factory
{
    public function definition(): array
    {
        return [
            'label' => 'Q'.fake()->unique()->numberBetween(1, 999),
            'content' => fake()->sentence(),
        ];
    }
}
