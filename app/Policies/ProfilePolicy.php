<?php

namespace App\Policies;

use App\Enums\RoleEnum;
use App\Models\Enrollment;
use App\Models\Profile;
use App\Models\User;

class ProfilePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        if ($user->role->value === 'super admin') {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Profile $profile): bool
    {
        if ($user->role->value === 'super admin') {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        if ($user->role->value === 'super admin') {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * Super admins may always update. Users with the user role may update
     * their own profile only while registration is still open for at least
     * one of their enrolled intakes. Editing is blocked once the
     * registration closing date has expired for every enrolled intake.
     * Users without enrollments (or without a determinable closing date)
     * may still edit.
     */
    public function update(User $user, Profile $profile): bool
    {
        if ($user->role === RoleEnum::SuperAdmin) {
            return true;
        }

        if ($user->role !== RoleEnum::User) {
            return false;
        }

        if ($profile->user_id !== null && (int) $profile->user_id !== (int) $user->id) {
            return false;
        }

        $enrollments = $user->enrollments()->with('intake')->get();

        if ($enrollments->isEmpty()) {
            return true;
        }

        $withClosingDate = $enrollments->filter(
            fn (Enrollment $enrollment) => $enrollment->intake !== null
                && $enrollment->intake->registration_ends_at !== null
        );

        if ($withClosingDate->isEmpty()) {
            return true;
        }

        return $withClosingDate->contains(
            fn (Enrollment $enrollment) => now()->lte($enrollment->intake->registration_ends_at)
        );
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Profile $profile): bool
    {
        if ($user->role->value === 'super admin') {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Profile $profile): bool
    {
        if ($user->role->value === 'super admin') {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Profile $profile): bool
    {
        if ($user->role->value === 'super admin') {
            return true;
        }

        return false;
    }

    public function deleteAny(User $user): bool
    {
        if ($user->role->value === 'super admin') {
            return true;
        }

        return false;
    }
}
