<?php

namespace App\Livewire\Settings;

use App\Concerns\ProfileValidationRules;
use App\Models\District;
use App\Models\Gender;
use App\Models\Profile as ProfileModel;
use App\Models\University;
use Flux\Flux;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Profile settings')]
class Profile extends Component
{
    use ProfileValidationRules;

    public string $name = '';

    public string $email = '';

    public ?string $date_of_birth = null;

    public ?int $gender_id = null;

    public ?int $mobile_number = null;

    public ?string $present_address = null;

    public ?string $work_address = null;

    public ?int $post_code = null;

    public ?int $district_id = null;

    public string|int|null $university_id = null;

    public ?string $other_university_name = null;

    public ?string $occupation = null;

    /**
     * Mount the component.
     */
    public function mount(): void
    {
        $user = Auth::user();

        $this->name = $user->name;
        $this->email = $user->email;

        $profile = $user->profile;

        if ($profile) {
            $this->date_of_birth = $profile->date_of_birth?->format('Y-m-d');
            $this->gender_id = $profile->gender_id;
            $this->mobile_number = $profile->mobile_number;
            $this->present_address = $profile->present_address;
            $this->work_address = $profile->work_address;
            $this->post_code = $profile->post_code;
            $this->district_id = $profile->district_id;
            $this->other_university_name = $profile->other_university_name;
            $this->university_id = $profile->university_id ?? ($profile->other_university_name ? 'other' : null);
            $this->occupation = $profile->occupation;
        }
    }

    /**
     * Update the profile information for the currently authenticated user.
     */
    public function updateProfileInformation(): void
    {
        $user = Auth::user();

        Gate::authorize('update', $user->profile ?? new ProfileModel(['user_id' => $user->id]));

        $rules = $this->profileRules($user->id);
        unset($rules['email'], $rules['mobile_number']);

        if (($this->university_id ?? null) === 'other') {
            $rules['university_id'] = ['nullable', 'string'];
            $rules['other_university_name'] = ['required', 'string', 'max:255'];
        } else {
            $rules['other_university_name'] = ['nullable', 'string', 'max:255'];
        }

        $validated = $this->validate($rules);

        $user->fill(['name' => $validated['name'] ?? $this->name]);

        $user->save();

        $universityId = ($this->university_id ?? null) === 'other' ? null : $this->university_id;
        $otherUniversityName = ($this->university_id ?? null) === 'other' ? $this->other_university_name : null;

        $profileData = array_filter([
            'date_of_birth' => $this->date_of_birth,
            'gender_id' => $this->gender_id,
            'present_address' => $this->present_address,
            'work_address' => $this->work_address,
            'post_code' => $this->post_code,
            'district_id' => $this->district_id,
            'university_id' => $universityId,
            'other_university_name' => $otherUniversityName,
            'occupation' => $this->occupation,
        ], fn ($value) => $value !== null);

        if ($profileData || $user->profile || $universityId === null || $otherUniversityName === null) {
            $profile = $user->profile ?? new ProfileModel(['user_id' => $user->id]);

            $profile->fill($profileData);
            $profile->university_id = $universityId;
            $profile->other_university_name = $otherUniversityName;

            $profile->save();
        }

        Flux::toast(variant: 'success', text: __('Profile updated.'));
    }

    /**
     * Send an email verification notification to the current user.
     */
    public function resendVerificationNotification(): void
    {
        $user = Auth::user();

        if ($user->hasVerifiedEmail()) {
            $this->redirectIntended(default: route('dashboard', absolute: false));

            return;
        }

        $user->sendEmailVerificationNotification();

        Flux::toast(text: __('A new verification link has been sent to your email address.'));
    }

    #[Computed]
    public function hasUnverifiedEmail(): bool
    {
        return Auth::user() instanceof MustVerifyEmail && ! Auth::user()->hasVerifiedEmail();
    }

    #[Computed]
    public function showDeleteUser(): bool
    {
        return ! Auth::user() instanceof MustVerifyEmail
            || (Auth::user() instanceof MustVerifyEmail && Auth::user()->hasVerifiedEmail());
    }

    #[Computed]
    public function isProfileLocked(): bool
    {
        $user = Auth::user();

        return Gate::denies('update', $user->profile ?? new ProfileModel(['user_id' => $user->id]));
    }

    #[Computed]
    public function genders()
    {
        return Gender::orderBy('name')->get();
    }

    #[Computed]
    public function districts()
    {
        return District::orderBy('name')->get();
    }

    #[Computed]
    public function universities()
    {
        return University::orderBy('name')->get();
    }
}
