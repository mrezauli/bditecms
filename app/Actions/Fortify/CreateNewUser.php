<?php

namespace App\Actions\Fortify;

use App\Concerns\PasswordValidationRules;
use App\Concerns\ProfileValidationRules;
use App\Models\Answer;
use App\Models\District;
use App\Models\Enrollment;
use App\Models\Exam;
use App\Models\Gender;
use App\Models\Profile;
use App\Models\Site;
use App\Models\Type;
use App\Models\University;
use App\Models\User;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules, ProfileValidationRules;

    /**
     * @return array<string, array<int, ValidationRule|array<mixed>|string>>
     */
    protected function registrationRules(): array
    {
        return [
            ...$this->profileRules(),
            'password' => $this->passwordRules(),
            'exam_id' => ['required', Rule::exists(Exam::class, 'id')],
            'type_id' => ['required', Rule::exists(Type::class, 'id')],
            'site_id' => ['required', Rule::exists(Site::class, 'id')],
            'first_answer_id' => ['required', Rule::exists(Answer::class, 'id')],
            'second_answer_id' => ['required', Rule::exists(Answer::class, 'id')],
            'third_answer_id' => ['required', Rule::exists(Answer::class, 'id')],
            'fourth_answer_id' => ['required', Rule::exists(Answer::class, 'id')],
            'fifth_answer_id' => ['required', Rule::exists(Answer::class, 'id')],
            'sixth_answer_id' => ['required', Rule::exists(Answer::class, 'id')],
            'seventh_answer_id' => ['required', Rule::exists(Answer::class, 'id')],
            'eighth_answer_id' => ['required', Rule::exists(Answer::class, 'id')],
            'ninth_answer_id' => ['required', Rule::exists(Answer::class, 'id')],
            'date_of_birth' => ['required', 'date'],
            'gender_id' => ['required', Rule::exists(Gender::class, 'id')],
            'occupation' => ['required', 'string', 'max:255'],
            'mobile_number' => ['required', 'numeric'],
            'present_address' => ['required', 'string'],
            'work_address' => ['required', 'string'],
            'post_code' => ['required', 'numeric'],
            'district_id' => ['required', Rule::exists(District::class, 'id')],
            'university_id' => ['required', Rule::exists(University::class, 'id')],
        ];
    }

    public function create(array $input): User
    {
        Validator::make($input, $this->registrationRules())->validate();

        return DB::transaction(function () use ($input) {
            $user = User::create([
                'name' => $input['name'],
                'email' => $input['email'],
                'password' => $input['password'],
            ]);

            Profile::create([
                'user_id' => $user->id,
                'date_of_birth' => $input['date_of_birth'],
                'gender_id' => $input['gender_id'],
                'mobile_number' => $input['mobile_number'],
                'present_address' => $input['present_address'],
                'work_address' => $input['work_address'],
                'post_code' => $input['post_code'],
                'district_id' => $input['district_id'],
                'university_id' => $input['university_id'],
                'occupation' => $input['occupation'],
            ]);

            Enrollment::create([
                'user_id' => $user->id,
                'exam_id' => $input['exam_id'],
                'type_id' => $input['type_id'],
                'site_id' => $input['site_id'],
                'first_answer_id' => $input['first_answer_id'],
                'second_answer_id' => $input['second_answer_id'],
                'third_answer_id' => $input['third_answer_id'],
                'fourth_answer_id' => $input['fourth_answer_id'],
                'fifth_answer_id' => $input['fifth_answer_id'],
                'sixth_answer_id' => $input['sixth_answer_id'],
                'seventh_answer_id' => $input['seventh_answer_id'],
                'eighth_answer_id' => $input['eighth_answer_id'],
                'ninth_answer_id' => $input['ninth_answer_id'],
            ]);

            return $user;
        });
    }
}
