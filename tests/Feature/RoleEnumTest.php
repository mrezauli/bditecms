<?php

use App\Enums\RoleEnum;
use App\Models\User;

test('role enum has correct values', function () {
    expect(RoleEnum::User->value)->toBe('user');
    expect(RoleEnum::Admin->value)->toBe('admin');
    expect(RoleEnum::SuperAdmin->value)->toBe('super admin');
});

test('role enum has correct labels', function () {
    expect(RoleEnum::User->getLabel())->toBe('User');
    expect(RoleEnum::Admin->getLabel())->toBe('Admin');
    expect(RoleEnum::SuperAdmin->getLabel())->toBe('Super Admin');
});

test('role enum exposes backed values for database definitions', function () {
    expect(RoleEnum::values())->toBe([
        'user',
        'admin',
        'super admin',
    ]);
});

test('user factory stores role as backed string and casts it to enum', function () {
    $user = User::factory()->create();

    expect($user->role)->toBe(RoleEnum::User)
        ->and($user->getRawOriginal('role'))->toBe(RoleEnum::User->value);

    $this->assertDatabaseHas('users', [
        'id' => $user->id,
        'role' => RoleEnum::User->value,
    ]);
});
