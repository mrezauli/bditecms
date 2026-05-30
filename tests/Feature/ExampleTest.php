<?php

use App\Models\User;

test('returns a successful response', function () {
    $response = $this->get(route('home'));

    $response->assertOk();
});

test('guests see authentication links on the home page', function () {
    $response = $this->get(route('home'));

    $response
        ->assertOk()
        ->assertSee(route('login'), false)
        ->assertSee(route('register'), false)
        ->assertSeeText('Log in')
        ->assertSeeText('Register');
});

test('home page images use public asset urls', function () {
    $response = $this->get(route('home'));

    $response
        ->assertOk()
        ->assertSee(asset('assets/bditecLogo.png'), false)
        ->assertSee(asset('assets/ipaLogoWithoutName.jpg'), false)
        ->assertSee(asset('assets/bccLogo.png'), false)
        ->assertSee(asset('assets/ictdLogo.png'), false)
        ->assertSee(asset('assets/itpecLogo.gif'), false)
        ->assertSee(asset('assets/jicaLogo.png'), false);
});

test('authenticated users see the dashboard link on the home page', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get(route('home'));

    $response
        ->assertOk()
        ->assertSee(route('dashboard'), false)
        ->assertSeeText('Dashboard')
        ->assertDontSee(route('login'), false)
        ->assertDontSee(route('register'), false);
});
