<?php

namespace App\Policies;

use App\Models\Gender;
use App\Models\User;

class GenderPolicy
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
    public function view(User $user, Gender $gender): bool
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
     */
    public function update(User $user, Gender $gender): bool
    {
        if ($user->role->value === 'super admin') {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Gender $gender): bool
    {
        if ($user->role->value === 'super admin') {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Gender $gender): bool
    {
        if ($user->role->value === 'super admin') {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Gender $gender): bool
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
