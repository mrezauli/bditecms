<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use App\Models\District;
use App\Models\Gender;
use App\Models\Profile;
use App\Models\University;
use App\Models\User;
use Illuminate\Database\Seeder;
use RuntimeException;

class ProfileSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::where('role', RoleEnum::User->value)->get();
        $genders = Gender::all();
        $districts = District::all();
        $universities = University::all();
        $locations = [
            [
                'present_address' => 'House 18, Road 7, Dhanmondi, Dhaka',
                'work_address' => 'Motijheel Commercial Area, Dhaka',
            ],
            [
                'present_address' => 'House 24, Road 3, Mirpur, Dhaka',
                'work_address' => 'Banani Commercial Area, Dhaka',
            ],
            [
                'present_address' => 'Road 12, Uttara, Dhaka',
                'work_address' => 'Kawran Bazar, Dhaka',
            ],
            [
                'present_address' => 'College Road, Joydebpur, Gazipur',
                'work_address' => 'Tongi Industrial Area, Gazipur',
            ],
            [
                'present_address' => 'Road 2, Nasirabad, Chattogram',
                'work_address' => 'Agrabad Commercial Area, Chattogram',
            ],
            [
                'present_address' => 'Kazla, Motihar, Rajshahi',
                'work_address' => 'Shaheb Bazar, Rajshahi',
            ],
            [
                'present_address' => 'Sonadanga Residential Area, Khulna',
                'work_address' => 'Khalishpur Industrial Area, Khulna',
            ],
            [
                'present_address' => 'Ambarkhana, Sylhet',
                'work_address' => 'Zindabazar, Sylhet',
            ],
            [
                'present_address' => 'Jaleshwaritola, Bogura',
                'work_address' => 'Satmatha, Bogura',
            ],
            [
                'present_address' => 'Jahaj Company More, Rangpur',
                'work_address' => 'Paira Chattar, Rangpur',
            ],
        ];

        $occupations = [
            'Student',
            'Software Engineer',
            'University Lecturer',
            'Accountant',
            'Civil Engineer',
            'Bank Officer',
            'Teacher',
            'Business Owner',
            'Government Officer',
            'Doctor',
            'Nurse',
            'Marketing Officer',
        ];

        if ($users->isEmpty()) {
            return;
        }

        if ($genders->isEmpty() || $universities->isEmpty() || $locations === []) {
            throw new RuntimeException('Profile seeding requires genders, universities, and supported location data.');
        }

        foreach ($users as $user) {
            $location = $locations[array_rand($locations)];

            Profile::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'date_of_birth' => now()->subYears(random_int(16, 60))->subDays(random_int(0, 364))->toDateString(),
                    'gender_id' => $genders->random()->id,
                    'mobile_number' => (int) (random_int(100000000, 999999999)),
                    'present_address' => $location['present_address'],
                    'work_address' => $location['work_address'],
                    'post_code' => rand(1000, 9999),
                    'district_id' => $districts->random()->id,
                    'university_id' => $universities->random()->id,
                    'occupation' => $occupations[array_rand($occupations)],
                ],
            );
        }
    }
}
