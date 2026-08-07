<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use App\Models\Answer;
use App\Models\District;
use App\Models\Division;
use App\Models\Enrollment;
use App\Models\Exam;
use App\Models\ExamSession;
use App\Models\Gender;
use App\Models\HalfPasser;
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

            Answer::factory(1000)->create()->each->setStatus('active');
            District::factory(10)->create()->each->setStatus('active');
            Division::factory(10)->create()->each->setStatus('active');
            Enrollment::factory(10)->create();
            Exam::factory(10)->create()->each->setStatus('active');
            ExamSession::factory(10)->create()->each->setStatus('active');
            Gender::factory(10)->create()->each->setStatus('active');
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

            $this->call([
                QuestionSeeder::class,
                AnswerSeeder::class,
                DivisionSeeder::class,
                DistrictSeeder::class,

                SiteSeeder::class,
                ExamSeeder::class,
                TypeSeeder::class,

                EnrollmentSeeder::class,

                ExamSessionSeeder::class,
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
