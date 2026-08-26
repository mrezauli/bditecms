<?php

use App\Models\Intake;
use Illuminate\Support\Carbon;
use Tests\TestCase;

uses(TestCase::class);

afterEach(function () {
    Carbon::setTestNow();
});

test('registration window boundaries are respected', function (string $now, bool $expected) {
    Carbon::setTestNow($now);

    $intake = Intake::factory()->make([
        'registration_starts_at' => '2026-07-01 00:00:00',
        'registration_ends_at' => '2026-09-30 23:59:59',
    ]);

    expect($intake->isRegistrationOpen())->toBe($expected);
})->with([
    'day before opening' => ['2026-06-30 23:59:59', false],
    'exact opening moment' => ['2026-07-01 00:00:00', true],
    'middle of window' => ['2026-08-26 12:00:00', true],
    'exact closing moment' => ['2026-09-30 23:59:59', true],
    'moment after closing' => ['2026-10-01 00:00:00', false],
]);
