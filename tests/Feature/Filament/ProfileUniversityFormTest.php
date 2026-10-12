<?php

use App\Enums\RoleEnum;
use App\Filament\Resources\Profiles\Pages\EditProfile;
use App\Models\Profile;
use App\Models\User;
use Filament\Facades\Filament;
use Livewire\Livewire;

beforeEach(function () {
    Filament::setCurrentPanel('super-admin');

    $this->actingAs(User::factory()->create([
        'email_verified_at' => now(),
        'role' => RoleEnum::SuperAdmin,
    ]));
});

test('profile edit page loads with other university selected', function () {
    $profile = Profile::factory()->create([
        'university_id' => null,
        'other_university_name' => 'My Overseas University',
    ]);

    Livewire::test(EditProfile::class, ['record' => $profile->id])
        ->assertOk()
        ->assertSchemaStateSet([
            'university_id' => 'other',
            'other_university_name' => 'My Overseas University',
        ]);
});

test('profile edit page lists universities alphabetically with not listed first', function () {
    $profile = Profile::factory()->create();

    $component = Livewire::test(EditProfile::class, ['record' => $profile->id])->assertOk();

    $options = collect($component->instance()->getSchema('form')->getComponents())
        ->firstWhere(fn ($c): bool => $c->getName() === 'university_id')
        ->getOptions();

    $names = array_values($options);
    $universities = array_slice($names, 1);

    expect($names[0])->toBe('Not Listed');

    $sorted = $universities;
    natcasesort($sorted);

    expect(array_values($sorted))->toBe(array_values($universities));
});

test('admin can save profile with not listed university', function () {
    $profile = Profile::factory()->create();

    Livewire::test(EditProfile::class, ['record' => $profile->id])
        ->fillForm([
            'university_id' => 'other',
            'other_university_name' => 'Custom University',
        ])
        ->call('save')
        ->assertHasNoFormErrors();

    expect($profile->refresh()->university_id)->toBeNull();
    expect($profile->refresh()->other_university_name)->toBe('Custom University');
});

test('admin cannot save not listed university without a name', function () {
    $profile = Profile::factory()->create();

    Livewire::test(EditProfile::class, ['record' => $profile->id])
        ->fillForm([
            'university_id' => 'other',
            'other_university_name' => null,
        ])
        ->call('save')
        ->assertHasFormErrors(['other_university_name']);
});
