<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use App\Models\Answer;
use App\Models\District;
use App\Models\Division;
use App\Models\Enrollment;
use App\Models\Exam;
use App\Models\Gender;
use App\Models\HalfPasser;
use App\Models\Intake;
use App\Models\Profile;
use App\Models\Question;
use App\Models\Setting;
use App\Models\Site;
use App\Models\Type;
use App\Models\University;
use App\Models\UniversityCategory;
use App\Models\User;
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
        // User::updateOrCreate([
        //     'name' => 'Admin',
        //     'email' => 'admin@admin.admin',
        //     'email_verified_at' => now(),
        //     'password' => Hash::make('Pa$$w0rd!'),
        //     'remember_token' => Str::random(10),
        //     'role' => RoleEnum::Admin->value,
        // ]);

        // User::updateOrCreate([
        //     'name' => 'Super Admin',
        //     'email' => 'super@admin.superadmin',
        //     'email_verified_at' => now(),
        //     'password' => Hash::make('Pa$$w0rd!'),
        //     'remember_token' => Str::random(10),
        //     'role' => RoleEnum::SuperAdmin->value,
        // ]);

        // User::updateOrCreate([
        //     'name' => 'User 1',
        //     'email' => 'user1@user.user',
        //     'email_verified_at' => now(),
        //     'password' => Hash::make('Pa$$w0rd!'),
        //     'remember_token' => Str::random(10),
        //     'role' => RoleEnum::User->value,
        // ])->setStatus('active');

        // User::updateOrCreate([
        //     'name' => 'User 2',
        //     'email' => 'user2@user.user',
        //     'email_verified_at' => now(),
        //     'password' => Hash::make('Pa$$w0rd!'),
        //     'remember_token' => Str::random(10),
        //     'role' => RoleEnum::User->value,
        // ])->setStatus('active');

        User::updateOrCreate([
            'name' => 'User 3',
            'email' => 'user3@user.user',
            'email_verified_at' => now(),
            'password' => Hash::make('Pa$$w0rd!'),
            'remember_token' => Str::random(10),
            'role' => RoleEnum::User->value,
        ]);

        if (App::environment('local')) {
            Answer::factory(1000)->create()->each->setStatus('active');
            District::factory(10)->create()->each->setStatus('active');
            Division::factory(10)->create()->each->setStatus('active');
            Enrollment::factory(10)->create();
            Exam::factory(10)->create()->each->setStatus('active');
            Gender::factory(10)->create()->each->setStatus('active');
            Intake::factory(10)->create()->each->setStatus('active');
            HalfPasser::factory(10)->create();
            Profile::factory(20)->create();
            Question::factory(9)->create()->each->setStatus('active');
            Setting::factory(9)->create();
            Site::factory(10)->create()->each->setStatus('active');
            Type::factory(10)->create()->each->setStatus('active');
            University::factory(10)->create()->each->setStatus('active');
            UniversityCategory::factory(10)->create()->each->setStatus('active');
            User::factory(10)->create();
        } else {
            $this->call([
                QuestionSeeder::class,
                AnswerSeeder::class,
                DivisionSeeder::class,
                DistrictSeeder::class,

                SiteSeeder::class,
                ExamSeeder::class,
                TypeSeeder::class,
                IntakeSeeder::class,

                EnrollmentSeeder::class,

                GenderSeeder::class,

                SettingSeeder::class,

                UniversityCategorySeeder::class,
                UniversitySeeder::class,

                ProfileSeeder::class,

                HalfPasserSeeder::class,
            ]);
        }
    }
}
