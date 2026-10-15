<?php

use App\Models\User;
use Tests\TestCase;

uses(TestCase::class);

test('derives initials from the first two name words', function (string $name, string $expected) {
    $user = new User(['name' => $name]);

    expect($user->initials())->toBe($expected);
})->with([
    'two words' => ['John Doe', 'JD'],
    'single word' => ['Rahman', 'R'],
    'three words use the first two' => ['Mary Jane Watson', 'MJ'],
]);
