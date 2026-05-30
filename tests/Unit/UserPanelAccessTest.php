<?php

use App\Enums\RoleEnum;
use App\Models\User;
use Filament\Panel;
use Tests\TestCase;

uses(TestCase::class);

function createPanel(string $id): Panel
{
    $panel = new class extends Panel {};

    $property = (new ReflectionClass($panel))->getProperty('id');
    $property->setAccessible(true);
    $property->setValue($panel, $id);

    return $panel;
}

test('admin can only access the admin panel', function () {
    $adminPanel = createPanel('admin');
    $superAdminPanel = createPanel('super-admin');

    $user = User::factory()->make([
        'role' => RoleEnum::Admin,
        'email_verified_at' => now(),
    ]);

    expect($user->canAccessPanel($adminPanel))->toBeTrue()
        ->and($user->canAccessPanel($superAdminPanel))->toBeFalse();
});

test('super admin can only access the super admin panel', function () {
    $adminPanel = createPanel('admin');
    $superAdminPanel = createPanel('super-admin');

    $user = User::factory()->make([
        'role' => RoleEnum::SuperAdmin,
        'email_verified_at' => now(),
    ]);

    expect($user->canAccessPanel($adminPanel))->toBeFalse()
        ->and($user->canAccessPanel($superAdminPanel))->toBeTrue();
});

test('users without verified email cannot access any panel', function () {
    $adminPanel = createPanel('admin');
    $superAdminPanel = createPanel('super-admin');

    $user = User::factory()->make([
        'role' => RoleEnum::Admin,
        'email_verified_at' => null,
    ]);

    expect($user->canAccessPanel($adminPanel))->toBeFalse()
        ->and($user->canAccessPanel($superAdminPanel))->toBeFalse();
});
