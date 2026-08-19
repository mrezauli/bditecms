<?php

namespace App\Policies;

use App\Models\Intake;
use App\Models\User;

class IntakePolicy
{
    public function viewAny(User $user): bool
    {
        if ($user->role->value === 'super admin') {
            return true;
        }

        return false;
    }

    public function view(User $user, Intake $intake): bool
    {
        if ($user->role->value === 'super admin') {
            return true;
        }

        return false;
    }

    public function create(User $user): bool
    {
        if ($user->role->value === 'super admin') {
            return true;
        }

        return false;
    }

    public function update(User $user, Intake $intake): bool
    {
        if ($user->role->value === 'super admin') {
            return true;
        }

        return false;
    }

    public function delete(User $user, Intake $intake): bool
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

    public function restore(User $user, Intake $intake): bool
    {
        if ($user->role->value === 'super admin') {
            return true;
        }

        return false;
    }

    public function forceDelete(User $user, Intake $intake): bool
    {
        if ($user->role->value === 'super admin') {
            return true;
        }

        return false;
    }
}
