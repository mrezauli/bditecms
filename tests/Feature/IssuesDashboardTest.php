<?php

use App\Livewire\Issues\Dashboard;
use App\Models\User;
use Livewire\Livewire;

test('complaint box shows bditec support phone numbers', function () {
    $this->actingAs(User::factory()->create(['email_verified_at' => now()]));

    Livewire::test(Dashboard::class)
        ->assertOk()
        ->assertSee('02-55006847')
        ->assertSee('02-8181032')
        ->assertSee('02-8181033')
        ->assertSee('01857321122');
});
