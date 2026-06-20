<?php

use App\Enums\RoleEnum;
use App\Models\User;

test('guests are redirected to the login page', function () {
    $response = $this->get(route('dashboard'));
    $response->assertRedirect(route('login'));
});

test('authenticated users can visit the dashboard', function () {
    $user = User::factory()->create([
        'email_verified_at' => now(),
        'role' => RoleEnum::User,
    ]);
    $this->actingAs($user);

    $response = $this->get(route('dashboard'));
    $response->assertOk();
});

test('authenticated verified users without the user role cannot visit the dashboard', function (RoleEnum $role) {
    $user = User::factory()->create([
        'email_verified_at' => now(),
        'role' => $role,
    ]);
    $this->actingAs($user);

    $response = $this->get(route('dashboard'));
    $response->assertForbidden();
})->with([
    'admin' => RoleEnum::Admin,
    'super admin' => RoleEnum::SuperAdmin,
]);
