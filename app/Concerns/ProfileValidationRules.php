<?php

namespace App\Concerns;

use App\Models\District;
use App\Models\Gender;
use App\Models\Profile;
use App\Models\Setting;
use App\Models\University;
use App\Models\User;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Validation\Rule;

trait ProfileValidationRules
{
    /**
     * Get the minimum allowed date of birth based on the next BDITEC intake.
     * Exams are held on April 24-25 and in October. The cutoff is the 1st of the
     * next upcoming session month minus the configured minimum age.
     */
    public static function minimumDateOfBirth(): string
    {
        $minimumAge = Setting::getInt('minimum_age_years', 20);
        $now = now();
        $month = $now->month;

        if ($month >= 10) {
            $cutoff = $now->copy()->addYear()->month(4)->day(1);
        } elseif ($month >= 4) {
            $cutoff = $now->copy()->month(10)->day(1);
        } else {
            $cutoff = $now->copy()->month(4)->day(1);
        }

        return $cutoff->subYears($minimumAge)->format('Y-m-d');
    }

    /**
     * Get the validation rules used to validate user profiles.
     *
     * @return array<string, array<int, ValidationRule|array<mixed>|string>>
     */
    protected function profileRules(?int $userId = null): array
    {
        return [
            'name' => $this->nameRules(),
            'email' => $this->emailRules($userId),
            'date_of_birth' => ['nullable', 'date', 'before_or_equal:'.static::minimumDateOfBirth()],
            'gender_id' => ['nullable', 'exists:'.Gender::class.',id'],
            'mobile_number' => $this->mobileRules($userId),
            'present_address' => ['nullable', 'string', 'max:500'],
            'work_address' => ['nullable', 'string', 'max:500'],
            'post_code' => ['nullable', 'integer', 'min:1000', 'max:9999'],
            'district_id' => ['nullable', 'exists:'.District::class.',id'],
            'university_id' => ['nullable', 'exists:'.University::class.',id'],
            'occupation' => ['nullable', 'string', 'max:20'],
        ];
    }

    /**
     * Get the validation rules used to validate mobile numbers.
     *
     * @return array<int, ValidationRule|array<mixed>|string>
     */
    protected function mobileRules(?int $userId = null): array
    {
        $unique = Rule::unique(Profile::class, 'mobile_number');

        if ($userId !== null) {
            $unique->ignore($userId, 'user_id');
        }

        return ['nullable', 'integer', $unique];
    }

    /**
     * Get the validation rules used to validate user names.
     *
     * @return array<int, ValidationRule|array<mixed>|string>
     */
    protected function nameRules(): array
    {
        return ['required', 'string', 'max:255', 'regex:/^[a-zA-Z0-9\s\-\'\.@()]+$/u'];
    }

    /**
     * Get the validation rules used to validate user emails.
     *
     * @return array<int, ValidationRule|array<mixed>|string>
     */
    protected function emailRules(?int $userId = null): array
    {
        return [
            'required',
            'string',
            'email',
            'max:255',
            $userId === null
                ? Rule::unique(User::class)
                : Rule::unique(User::class)->ignore($userId),
        ];
    }
}
