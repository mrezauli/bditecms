<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use App\Models\District;
use App\Models\Gender;
use App\Models\Profile;
use App\Models\University;
use App\Models\User;
use Illuminate\Database\Seeder;

class ProfileSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::where('role', RoleEnum::User->value)->get();
        $genders = Gender::all();
        $districts = District::all();
        $universities = University::all();

        foreach ($users as $user) {
            Profile::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'date_of_birth' => fake()->dateTimeBetween('-40 years', '-20 years')->format('Y-m-d'),
                    'gender_id' => $genders->random()->id,
                    'mobile_number' => fake()->numerify('#########'),
                    'present_address' => fake()->streetAddress().', '.fake()->city(),
                    'work_address' => fake()->company().', '.fake()->city(),
                    'post_code' => fake()->numberBetween(1000, 9999),
                    'district_id' => $districts->random()->id,
                    'university_id' => $universities->random()->id,
                    'occupation' => fake()->randomElement(['Student', 'Software Engineer', 'Lecturer', 'System Analyst', 'Network Engineer', 'Data Analyst']),
                ],
            );
        }
    }
}
