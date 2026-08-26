<?php

use App\Actions\Fortify\CreateNewUser;
use App\Models\Setting;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Tests\TestCase;

uses(TestCase::class, RefreshDatabase::class);

afterEach(function () {
    Carbon::setTestNow();
});

test('minimum date of birth follows the next intake session', function (string $now, string $expectedCutoff) {
    Carbon::setTestNow($now);

    expect(CreateNewUser::minimumDateOfBirth())->toBe($expectedCutoff);
})->with([
    'before april points to april session' => ['2026-02-10', '2006-04-01'],
    'between sessions points to october session' => ['2026-05-20', '2006-10-01'],
    'after october points to next april session' => ['2026-11-03', '2007-04-01'],
]);

test('configured minimum age shifts the cutoff', function () {
    Carbon::setTestNow('2026-05-20');

    Setting::factory()->create(['key' => 'minimum_age_years', 'value' => '18']);

    expect(CreateNewUser::minimumDateOfBirth())->toBe('2008-10-01');
});
