<?php

namespace App\Policies;

use App\Models\ExamSession;
use App\Models\User;

class ExamSessionPolicy
{
    public function viewAny(User $user): bool
    {
        if ($user->role->value === 'super admin') {
            return true;
        }

        return false;
    }

    public function view(User $user, ExamSession $examSession): bool
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

    public function update(User $user, ExamSession $examSession): bool
    {
        if ($user->role->value === 'super admin') {
            return true;
        }

        return false;
    }

    public function delete(User $user, ExamSession $examSession): bool
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

    public function restore(User $user, ExamSession $examSession): bool
    {
        if ($user->role->value === 'super admin') {
            return true;
        }

        return false;
    }

    public function forceDelete(User $user, ExamSession $examSession): bool
    {
        if ($user->role->value === 'super admin') {
            return true;
        }

        return false;
    }
}
