<?php

use App\Enums\RoleEnum;
use App\Filament\Resources\Users\Pages\CreateUser;
use App\Models\User;
use Filament\Facades\Filament;
use Livewire\Livewire;

use function Pest\Laravel\assertDatabaseHas;

test('user resource role select saves the selected enum value', function () {
    Filament::setCurrentPanel('super-admin');

    $this->actingAs(User::factory()->create([
        'email_verified_at' => now(),
        'role' => RoleEnum::SuperAdmin,
    ]));

    $newUser = User::factory()->make([
        'role' => RoleEnum::Admin,
    ]);

    Livewire::test(CreateUser::class)
        ->set('data.name', $newUser->name)
        ->set('data.email', $newUser->email)
        ->set('data.password', 'Pa$$w0rd!')
        ->set('data.role', RoleEnum::Admin->value)
        ->call('create')
        ->assertHasNoFormErrors()
        ->assertRedirect();

    assertDatabaseHas(User::class, [
        'email' => $newUser->email,
        'role' => RoleEnum::Admin->value,
    ]);
});
