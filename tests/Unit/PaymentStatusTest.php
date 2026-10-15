<?php

use App\Models\Payment;
use Tests\TestCase;

uses(TestCase::class);

test('reports completion from the payment status', function (string $status, bool $expected) {
    $payment = new Payment(['status' => $status]);

    expect($payment->isComplete())->toBe($expected);
})->with([
    'complete' => ['Complete', true],
    'pending' => ['Pending', false],
    'failed' => ['Failed', false],
    'canceled' => ['Canceled', false],
]);

test('reports pending state from the payment status', function (string $status, bool $expected) {
    $payment = new Payment(['status' => $status]);

    expect($payment->isPending())->toBe($expected);
})->with([
    'pending' => ['Pending', true],
    'complete' => ['Complete', false],
    'failed' => ['Failed', false],
    'canceled' => ['Canceled', false],
]);
