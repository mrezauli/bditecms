<?php

namespace App\Policies;

use App\Models\Setting;
use App\Models\User;

class SettingPolicy
{
    public function viewAny(User $user): bool
    {
        if ($user->role->value === 'super admin') {
            return true;
        }

        return false;
    }

    public function view(User $user, Setting $setting): bool
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

    public function update(User $user, Setting $setting): bool
    {
        if ($user->role->value === 'super admin') {
            return true;
        }

        return false;
    }

    public function delete(User $user, Setting $setting): bool
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

    public function restore(User $user, Setting $setting): bool
    {
        if ($user->role->value === 'super admin') {
            return true;
        }

        return false;
    }

    public function forceDelete(User $user, Setting $setting): bool
    {
        if ($user->role->value === 'super admin') {
            return true;
        }

        return false;
    }
}
