<?php

use App\Livewire\Settings\Profile;
use App\Models\User;
use Livewire\Livewire;

test('profile page is displayed', function () {
    $this->actingAs($user = User::factory()->create());

    $this->get('/settings/profile')->assertOk();
});

test('profile information can be updated', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    $response = Livewire::test(Profile::class)
        ->set('name', 'Test User')
        ->set('email', 'test@example.com')
        ->set('date_of_birth', '2000-01-15')
        ->set('mobile_number', '123456789')
        ->set('present_address', '123 Main Street')
        ->set('work_address', '456 Work Avenue')
        ->set('post_code', '1234')
        ->set('occupation', 'Engineer')
        ->call('updateProfileInformation');

    $response->assertHasNoErrors();

    $user->refresh();

    expect($user->name)->toEqual('Test User');
    expect($user->email)->toEqual('test@example.com');
    expect($user->email_verified_at)->toBeNull();

    $profile = $user->profile;

    expect($profile)->not->toBeNull();
    expect($profile->date_of_birth->format('Y-m-d'))->toEqual('2000-01-15');
    expect($profile->mobile_number)->toEqual('123456789');
    expect($profile->present_address)->toEqual('123 Main Street');
    expect($profile->work_address)->toEqual('456 Work Avenue');
    expect((string) $profile->post_code)->toEqual('1234');
    expect($profile->occupation)->toEqual('Engineer');
});

test('email verification status is unchanged when email address is unchanged', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    $response = Livewire::test(Profile::class)
        ->set('name', 'Test User')
        ->set('email', $user->email)
        ->call('updateProfileInformation');

    $response->assertHasNoErrors();

    expect($user->refresh()->email_verified_at)->not->toBeNull();
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
