<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use App\Models\Answer;
use App\Models\District;
use App\Models\Division;
use App\Models\Exam;
use App\Models\Gender;
use App\Models\Profile;
use App\Models\Question;
use App\Models\Site;
use App\Models\Type;
use App\Models\University;
use App\Models\UniversityCategory;
use App\Models\User;
use Database\Seeders\UniversityCategorySeeder;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        if (App::environment('local')) {
            User::factory()->create([
                'name' => 'User',
                'email' => 'user@user.user',
                'email_verified_at' => now(),
                'password' => Hash::make('Pa$$w0rd!'),
                'remember_token' => Str::random(10),
                'role' => RoleEnum::User->value,
            ]);

            User::factory()->create([
                'name' => 'Admin',
                'email' => 'admin@admin.admin',
                'email_verified_at' => now(),
                'password' => Hash::make('Pa$$w0rd!'),
                'remember_token' => Str::random(10),
                'role' => RoleEnum::Admin->value,
            ]);

            User::factory()->create([
                'name' => 'Super Admin',
                'email' => 'super@admin.superadmin',
                'email_verified_at' => now(),
                'password' => Hash::make('Pa$$w0rd!'),
                'remember_token' => Str::random(10),
                'role' => RoleEnum::SuperAdmin->value,
            ]);

            User::factory(7)->create();
            Exam::factory(10)->create();
            Type::factory(10)->create();
            Site::factory(10)->create();
            Question::factory(10)->create();
            Answer::factory(10)->create();
            Division::factory(10)->create();
            District::factory(10)->create();
            UniversityCategory::factory(10)->create();
            University::factory(10)->create();
            Gender::factory(2)->create();
            Profile::factory(10)->create();
        } else {
            User::factory()->create([
                'name' => 'Director',
                'email' => 'director.bditec@bcc.gov.bd',
                'email_verified_at' => now(),
                'password' => Hash::make('Pa$$w0rd!'),
                'remember_token' => Str::random(10),
                'role' => RoleEnum::Admin->value,
            ]);

            User::factory()->create([
                'name' => 'Super Admin',
                'email' => 'super@admin.superadmin',
                'email_verified_at' => now(),
                'password' => Hash::make('Pa$$w0rd!'),
                'remember_token' => Str::random(10),
                'role' => RoleEnum::SuperAdmin->value,
            ]);

            $this->call([
                ExamSeeder::class,
                TypeSeeder::class,
                SiteSeeder::class,
                QuestionSeeder::class,
                AnswerSeeder::class,
                DivisionSeeder::class,
                DistrictSeeder::class,
                UniversityCategorySeeder::class,
                UniversitySeeder::class,
                GenderSeeder::class,
                ProfileSeeder::class,
            ]);
        }
    }
}
