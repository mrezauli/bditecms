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
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => fn (): ?int => User::inRandomOrder()->value('id'),
            'date_of_birth' => fake()->dateTimeBetween('-80 years', '-16 years')->format('Y-m-d'),
            'gender_id' => fn (): ?int => Gender::inRandomOrder()->value('id'),
            'mobile_number' => fake()->randomDigitNotZero(),
            'present_address' => fake()->address(),
            'work_address' => fake()->address(),
            'post_code' => fake()->numberBetween(1000, 9999),
            'district_id' => fn (): ?int => District::inRandomOrder()->value('id'),
            'university_id' => fn (): ?int => University::inRandomOrder()->value('id'),
            'other_university_name' => null,
            'occupation' => fake()->word(),
        ];
    }
}
