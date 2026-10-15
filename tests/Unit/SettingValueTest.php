<?php

use App\Models\Setting;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

uses(TestCase::class, RefreshDatabase::class);

test('returns the stored setting value', function () {
    Setting::factory()->create(['key' => 'minimum_age_years', 'value' => '20']);

    expect(Setting::getValue('minimum_age_years'))->toBe('20');
});

test('falls back to the default when the key is missing', function () {
    expect(Setting::getValue('missing_key', 'fallback'))->toBe('fallback');
});

test('casts a numeric setting value to int', function () {
    Setting::factory()->create(['key' => 'minimum_age_years', 'value' => '20']);

    expect(Setting::getInt('minimum_age_years'))->toBe(20);
});

test('falls back to the default int when the key is missing', function () {
    expect(Setting::getInt('missing_key', 10))->toBe(10);
});
