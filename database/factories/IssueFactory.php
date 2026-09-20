<?php

namespace Database\Factories;

use App\Models\Issue;
use App\Models\IssueCategory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Issue>
 */
class IssueFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'issue_category_id' => IssueCategory::factory(),
            'subject' => fake()->sentence(),
            'priority' => fake()->randomElement(['low', 'medium', 'high']),
            'status' => 'open',
        ];
    }
}
