<?php

use App\Enums\RoleEnum;
use App\Filament\Resources\Users\Tables\UsersTable;
use App\Models\User;
use Tests\TestCase;

uses(TestCase::class);

test('user table rows highlight each privileged role', function (RoleEnum $role, ?string $classes) {
    $user = new User([
        'role' => $role,
    ]);

    expect(UsersTable::roleRowClasses($user))->toBe($classes);
})->with([
    'user' => [RoleEnum::User, null],
    'admin' => [RoleEnum::Admin, 'bg-emerald-50/80 dark:bg-emerald-950/30'],
    'super admin' => [RoleEnum::SuperAdmin, 'bg-amber-50/80 dark:bg-amber-950/30'],
]);
