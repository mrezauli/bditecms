<?php

use App\Enums\RoleEnum;
use App\Livewire\Settings\Profile;
use App\Models\Enrollment;
use App\Models\Intake;
use App\Models\User;
use Livewire\Livewire;

test('profile page is displayed', function () {
    $this->actingAs($user = User::factory()->create());

    $this->get('/settings/profile')->assertOk();
});

test('profile information can be updated', function () {
    $user = User::factory()->create(['email_verified_at' => now()]);

    $this->actingAs($user);

    $response = Livewire::test(Profile::class)
        ->set('name', 'Test User')
        ->set('date_of_birth', '2000-01-15')
        ->set('present_address', '123 Main Street')
        ->set('work_address', '456 Work Avenue')
        ->set('post_code', '1234')
        ->set('occupation', 'Engineer')
        ->call('updateProfileInformation');

    $response->assertHasNoErrors();

    $user->refresh();

    expect($user->name)->toEqual('Test User');
    expect($user->email)->toEqual($user->email);
    expect($user->email_verified_at)->not->toBeNull();

    $profile = $user->profile;

    expect($profile)->not->toBeNull();
    expect($profile->date_of_birth->format('Y-m-d'))->toEqual('2000-01-15');
    expect($profile->present_address)->toEqual('123 Main Street');
    expect($profile->work_address)->toEqual('456 Work Avenue');
    expect((string) $profile->post_code)->toEqual('1234');
    expect($profile->occupation)->toEqual('Engineer');
});

test('email and mobile number cannot be changed from profile settings', function () {
    $user = User::factory()->create(['email_verified_at' => now()]);
    $profile = App\Models\Profile::factory()->create(['user_id' => $user->id, 'mobile_number' => 333333333]);

    $this->actingAs($user);

    $originalEmail = $user->email;

    $response = Livewire::test(Profile::class)
        ->set('name', 'Test User')
        ->set('email', 'hacker@example.com')
        ->set('mobile_number', 999999999)
        ->call('updateProfileInformation');

    $response->assertHasNoErrors();

    $user->refresh();

    expect($user->email)->toEqual($originalEmail);
    expect($user->email_verified_at)->not->toBeNull();
    expect($user->profile->mobile_number)->toEqual(333333333);
});

test('email verification status is unchanged on profile update', function () {
    $user = User::factory()->create(['email_verified_at' => now()]);

    $this->actingAs($user);

    $response = Livewire::test(Profile::class)
        ->set('name', 'Test User')
        ->call('updateProfileInformation');

    $response->assertHasNoErrors();

    expect($user->refresh()->email_verified_at)->not->toBeNull();
});

test('university not listed can be saved with other name', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    $response = Livewire::test(Profile::class)
        ->set('name', 'Test User')
        ->set('university_id', 'other')
        ->set('other_university_name', 'Custom University')
        ->call('updateProfileInformation');

    $response->assertHasNoErrors();

    $profile = $user->refresh()->profile;

    expect($profile->university_id)->toBeNull();
    expect($profile->other_university_name)->toEqual('Custom University');
});

test('super admin can update profile after registration has closed', function () {
    $user = User::factory()->create([
        'email_verified_at' => now(),
        'role' => RoleEnum::SuperAdmin->value,
    ]);

    $closedIntake = Intake::factory()->create([
        'registration_starts_at' => now()->subDays(10),
        'registration_ends_at' => now()->subDay(),
    ]);

    Enrollment::factory()->create([
        'user_id' => $user->id,
        'intake_id' => $closedIntake->id,
    ]);

    $this->actingAs($user);

    $response = Livewire::test(Profile::class)
        ->set('name', 'Admin Updated')
        ->call('updateProfileInformation');

    $response->assertHasNoErrors();

    expect($user->refresh()->name)->toEqual('Admin Updated');
});

test('profile cannot be updated after registration has closed', function () {
    $user = User::factory()->create(['email_verified_at' => now()]);

    $closedIntake = Intake::factory()->create([
        'registration_starts_at' => now()->subDays(10),
        'registration_ends_at' => now()->subDay(),
    ]);

    Enrollment::factory()->create([
        'user_id' => $user->id,
        'intake_id' => $closedIntake->id,
    ]);

    $this->actingAs($user);

    $response = Livewire::test(Profile::class)
        ->set('name', 'Hacker Change')
        ->call('updateProfileInformation');

    $response->assertForbidden();

    expect($user->refresh()->name)->not->toEqual('Hacker Change');
});

test('profile can be updated while registration is open', function () {
    $user = User::factory()->create(['email_verified_at' => now()]);

    $openIntake = Intake::factory()->create([
        'registration_starts_at' => now()->subDay(),
        'registration_ends_at' => now()->addDays(5),
    ]);

    Enrollment::factory()->create([
        'user_id' => $user->id,
        'intake_id' => $openIntake->id,
    ]);

    $this->actingAs($user);

    $response = Livewire::test(Profile::class)
        ->set('name', 'Open Window User')
        ->call('updateProfileInformation');

    $response->assertHasNoErrors();

    expect($user->refresh()->name)->toEqual('Open Window User');
});
test('profile information can be updated when profile already exists', function () {
    $user = User::factory()->create();
    $profile = App\Models\Profile::factory()->create(['user_id' => $user->id]);

    $this->actingAs($user);

    $response = Livewire::test(Profile::class)
        ->set('name', 'Updated User')
        ->set('date_of_birth', '1995-05-20')
        ->set('occupation', 'Doctor')
        ->call('updateProfileInformation');

    $response->assertHasNoErrors();

    $user->refresh();

    expect($user->name)->toEqual('Updated User');

    expect($user->profile->date_of_birth->format('Y-m-d'))->toEqual('1995-05-20');
    expect($user->profile->occupation)->toEqual('Doctor');
});

test('user can delete their account', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    $response = Livewire::test('settings.delete-user-form')
        ->set('password', 'password')
        ->call('deleteUser');

    $response
        ->assertHasNoErrors()
        ->assertRedirect('/');

    expect($user->fresh())->toBeNull();
    expect(auth()->check())->toBeFalse();
});

test('correct password must be provided to delete account', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    $response = Livewire::test('settings.delete-user-form')
        ->set('password', 'wrong-password')
        ->call('deleteUser');

    $response->assertHasErrors(['password']);

    expect($user->fresh())->not->toBeNull();
});
