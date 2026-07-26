<?php

namespace App\Actions\Fortify;

use App\Concerns\PasswordValidationRules;
use App\Concerns\ProfileValidationRules;
use App\Models\Answer;
use App\Models\District;
use App\Models\Enrollment;
use App\Models\Exam;
use App\Models\ExamSession;
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
            'type_id' => ['nullable', Rule::exists(Type::class, 'id')],
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
            'date_of_birth' => ['required', 'date', 'before_or_equal:'.static::minimumDateOfBirth()],
            'gender_id' => ['required', Rule::exists(Gender::class, 'id')],
            'occupation' => ['required', 'string', 'max:20', 'regex:/^[a-zA-Z0-9\s\-\'\.@()]+$/u'],
            'mobile_number' => ['required', 'integer', 'digits:9', 'regex:/^[3-9]\d{9}$/'],
            'present_address' => ['required', 'string', 'regex:/^[a-zA-Z0-9\s\-\'\.@(),]+$/u'],
            'work_address' => ['required', 'string', 'regex:/^[a-zA-Z0-9\s\-\'\.@(),]+$/u'],
            'post_code' => ['required', 'integer', 'min:1000', 'max:9999'],
            'district_id' => ['required', Rule::exists(District::class, 'id')],
            'university_id' => ['required', Rule::exists(University::class, 'id')],
        ];
    }

    public function create(array $input): User
    {
        $rules = $this->registrationRules();

        if (($input['university_id'] ?? null) === 'other') {
            $rules['university_id'] = ['nullable', 'string'];
            $rules['other_university_name'] = ['required', 'string', 'max:255'];
        } else {
            $rules['university_id'] = ['required', Rule::exists(University::class, 'id')];
            $rules['other_university_name'] = ['nullable', 'string', 'max:255'];
        }

        $feExamId = Exam::where('acronym', 'FE')->value('id');

        if ((int) ($input['exam_id'] ?? null) === $feExamId) {
            $rules['passed_before'] = ['required', Rule::in(['yes', 'no'])];

            if (($input['passed_before'] ?? null) === 'yes') {
                $rules['examinee_id'] = ['required', 'string', 'max:255'];
                $rules['type_id'] = ['required', Rule::exists(Type::class, 'id')];
            } else {
                $bothTypeId = Type::where('exam_id', $feExamId)->where('name', 'Both (FE: Morning & Afternoon Exam)')->value('id');
                $input['type_id'] = $bothTypeId;
            }
        }

        $session = ExamSession::where('exam_id', $input['exam_id'])->openForRegistration()->first();

        if (! $session) {
            $exam = Exam::find($input['exam_id']);

            $validator = Validator::make($input, $rules);
            $validator->after(fn ($v) => $v->errors()->add('exam_id', __('Registration is not open for :exam at this time.', ['exam' => $exam?->name ?? 'this exam'])));
            $validator->validate();
        }

        $validator = Validator::make($input, $rules);

        if ((int) ($input['exam_id'] ?? null) === $feExamId && ($input['passed_before'] ?? null) === 'yes') {
            $foundInAm = Enrollment::where('am_exam', $input['examinee_id'])->exists();
            $foundInPm = Enrollment::where('pm_exam', $input['examinee_id'])->exists();

            if ($foundInAm && $foundInPm) {
                $validator->after(fn ($v) => $v->errors()->add('examinee_id', __('You should not register because you are already passed.')));
            } elseif (! $foundInAm && ! $foundInPm) {
                $validator->after(fn ($v) => $v->errors()->add('examinee_id', __('Invalid ID.')));
            }
        }

        $validator->validate();

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
                'university_id' => $input['university_id'] === 'other' ? null : $input['university_id'],
                'other_university_name' => $input['other_university_name'] ?? null,
                'occupation' => $input['occupation'],
            ]);

            Enrollment::create([
                'user_id' => $user->id,
                'exam_session_id' => $session->id,
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
