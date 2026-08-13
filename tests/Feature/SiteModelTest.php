<?php

use App\Models\Division;
use App\Models\Site;

test('site belongs to a division', function () {
    $division = Division::factory()->create();

    $site = Site::factory()->for($division)->create();

    expect($site->division)->toBeInstanceOf(Division::class)
        ->and($site->division->id)->toBe($division->id);
});

test('site factory creates a division when none exists', function () {
    $site = Site::factory()->create();

    expect($site->division_id)->not->toBeNull();
});
