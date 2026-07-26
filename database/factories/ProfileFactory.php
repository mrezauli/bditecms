<?php

namespace Database\Factories;

use App\Models\District;
use App\Models\Gender;
use App\Models\Profile;
use App\Models\University;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Profile>
 */
class ProfileFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'date_of_birth' => fake()->dateTimeBetween('-40 years', '-20 years')->format('Y-m-d'),
            'gender_id' => Gender::inRandomOrder()->value('id') ?? Gender::factory(),
            'mobile_number' => (string) fake()->numerify('1##########'),
            'present_address' => fake()->streetAddress().', '.fake()->city(),
            'work_address' => fake()->company().', '.fake()->city(),
            'post_code' => fake()->numberBetween(1000, 9999),
            'district_id' => District::inRandomOrder()->value('id') ?? District::factory(),
            'university_id' => University::inRandomOrder()->value('id') ?? University::factory(),
            'other_university_name' => null,
            'occupation' => fake()->randomElement(['Student', 'Software Engineer', 'Lecturer', 'System Analyst', 'Network Engineer', 'Data Analyst']),
        ];
    }
}
