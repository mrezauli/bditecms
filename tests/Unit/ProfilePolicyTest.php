<?php

use App\Enums\RoleEnum;
use App\Models\Enrollment;
use App\Models\Intake;
use App\Models\Profile;
use App\Models\User;
use App\Policies\ProfilePolicy;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Tests\TestCase;

uses(TestCase::class, RefreshDatabase::class);

afterEach(function () {
    Carbon::setTestNow();
});

function enrollUserInIntake(User $user, string $endsAt): void
{
    $intake = Intake::factory()->create([
        'registration_starts_at' => '2026-07-01 00:00:00',
        'registration_ends_at' => $endsAt,
    ]);

    Enrollment::factory()->create([
        'user_id' => $user->id,
        'intake_id' => $intake->id,
    ]);
}

test('super admin may update any profile after registration has closed', function () {
    Carbon::setTestNow('2026-10-01 00:00:00');

    $admin = User::factory()->create(['role' => RoleEnum::SuperAdmin]);
    $owner = User::factory()->create();
    $profile = Profile::factory()->create(['user_id' => $owner->id]);

    enrollUserInIntake($owner, '2026-09-30 23:59:59');

    expect(app(ProfilePolicy::class)->update($admin, $profile))->toBeTrue();
});

test('admin role may not update profiles', function () {
    $admin = User::factory()->create(['role' => RoleEnum::Admin]);
    $profile = Profile::factory()->create(['user_id' => User::factory()->create()->id]);

    expect(app(ProfilePolicy::class)->update($admin, $profile))->toBeFalse();
});

test('user may not update another user profile', function () {
    $user = User::factory()->create();
    $profile = Profile::factory()->create(['user_id' => User::factory()->create()->id]);

    expect(app(ProfilePolicy::class)->update($user, $profile))->toBeFalse();
});

test('user may update own profile without enrollments', function () {
    $user = User::factory()->create();
    $profile = Profile::factory()->create(['user_id' => $user->id]);

    expect(app(ProfilePolicy::class)->update($user, $profile))->toBeTrue();
});

test('user may update own profile while registration is open', function () {
    Carbon::setTestNow('2026-08-26 12:00:00');

    $user = User::factory()->create();
    $profile = Profile::factory()->create(['user_id' => $user->id]);

    enrollUserInIntake($user, '2026-09-30 23:59:59');

    expect(app(ProfilePolicy::class)->update($user, $profile))->toBeTrue();
});

test('user may not update own profile after registration has closed', function () {
    Carbon::setTestNow('2026-10-01 00:00:00');

    $user = User::factory()->create();
    $profile = Profile::factory()->create(['user_id' => $user->id]);

    enrollUserInIntake($user, '2026-09-30 23:59:59');

    expect(app(ProfilePolicy::class)->update($user, $profile))->toBeFalse();
});
