<?php

namespace App\Actions\Fortify;

use App\Concerns\PasswordValidationRules;
use App\Concerns\ProfileValidationRules;
use App\Models\Answer;
use App\Models\District;
use App\Models\Enrollment;
use App\Models\Exam;
use App\Models\Gender;
use App\Models\Intake;
use App\Models\Profile;
use App\Models\Site;
use App\Models\Type;
use App\Models\University;
use App\Models\User;
use App\Services\ExamineeResolver;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules, ProfileValidationRules;

    public function __construct(private readonly ExamineeResolver $examineeResolver) {}

    /**
     * @return array<string, array<int, ValidationRule|array<mixed>|string>>
     */
    protected function registrationRules(): array
    {
        return [
            ...$this->profileRules(),
            'password' => $this->passwordRules(),
            'exam_id' => ['required', Rule::exists(Exam::class, 'id')],
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
            'mobile_number' => ['required', 'integer', 'digits:9', 'regex:/^[3-9]\d{8}$/u', Rule::unique(Profile::class, 'mobile_number')],
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

        // University "Not Listed" flow.
        if (($input['university_id'] ?? null) === 'other') {
            $rules['university_id'] = ['nullable', 'string'];
            $rules['other_university_name'] = ['required', 'string', 'max:255'];
        } else {
            $rules['university_id'] = ['required', Rule::exists(University::class, 'id')];
            $rules['other_university_name'] = ['nullable', 'string', 'max:255'];
        }

        $feExamId = Exam::where('acronym', 'FE')->value('id');
        $isFe = (int) ($input['exam_id'] ?? null) === $feExamId;
        $resolution = null;

        // Type: required for FE (scoped to FE exam), nullable for IP.
        $rules['type_id'] = $isFe
            ? ['required', Rule::exists(Type::class, 'id')->where('exam_id', $feExamId)]
            : ['nullable'];

        if ($isFe) {
            $rules['passed_before'] = ['required', Rule::in(['yes', 'no'])];
            $rules['examinee_id'] = match (($input['passed_before'] ?? null)) {
                'yes' => ['required', 'string', 'max:255'],
                default => ['nullable'],
            };
            $rules['intake_id'] = match (($input['passed_before'] ?? null)) {
                'yes' => ['required', Rule::exists(Intake::class, 'id')],
                default => ['nullable'],
            };
        }

        if ($isFe) {
            if (($input['passed_before'] ?? null) === 'no') {
                $bothTypeId = Type::where('exam_id', $feExamId)
                    ->where('name', 'FE: Both - Morning (AM) & Afternoon (PM) Exam')
                    ->value('id');
                $input['type_id'] = $bothTypeId;
            }
        }

        $intake = Intake::where('exam_id', $input['exam_id'])->get()
            ->first(fn (Intake $intake) => $intake->isRegistrationOpen());

        if (! $intake) {
            $exam = Exam::find($input['exam_id']);
            $validator = Validator::make($input, $rules);
            $validator->after(fn ($v) => $v->errors()->add('exam_id', __('Registration is not open for :exam at this time.', ['exam' => $exam?->name ?? 'this exam'])));
            $validator->validate();
        }

        $validator = Validator::make($input, $rules);

        if ($isFe && ($input['passed_before'] ?? null) === 'yes') {
            $resolution = $this->examineeResolver->resolve($input['examinee_id'] ?? '', $input['intake_id'] ?? null);

            match ($resolution->status) {
                'both_passed' => $validator->after(fn ($v) => $v->errors()->add('examinee_id', __('You should not register because you are already passed.'))),
                'invalid' => $validator->after(fn ($v) => $v->errors()->add('examinee_id', __('Invalid ID.'))),
                'valid' => match (true) {
                    (int) ($input['type_id'] ?? 0) !== (int) $resolution->remainingTypeId => $validator->after(fn ($v) => $v->errors()->add('type_id', __('You passed in :exam exam so you can only participate in :other exam.', ['exam' => $resolution->passedSession === 'AM' ? 'AM' : 'PM', 'other' => $resolution->remainingTypeName]))),
                    $resolution->name !== null && trim((string) $input['name']) !== $resolution->name => $validator->after(fn ($v) => $v->errors()->add('name', __('The name must match the name registered for this examinee ID.'))),
                    default => null,
                },
            };
        }

        $validator->validate();

        return DB::transaction(function () use ($input, $intake) {
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
                'intake_id' => $intake->id,
                'exam_id' => $input['exam_id'],
                'type_id' => $input['type_id'] ?? null,
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
