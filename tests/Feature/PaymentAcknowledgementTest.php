<?php

use App\Enums\RoleEnum;
use App\Models\Enrollment;
use App\Models\Payment;
use App\Models\User;

function createAcknowledgementPayment(?User $owner = null): Payment
{
    $owner ??= User::factory()->create(['email_verified_at' => now()]);

    $enrollment = Enrollment::factory()->create(['user_id' => $owner->id]);

    return Payment::create([
        'enrollment_id' => $enrollment->id,
        'user_id' => $owner->id,
        'amount' => 500.00,
        'transaction_id' => 'TXN'.fake()->unique()->numerify('########'),
        'status' => 'Complete',
        'currency' => 'BDT',
    ]);
}

test('guest cannot download acknowledgement slip', function () {
    $payment = createAcknowledgementPayment();

    $this->get(route('payment.acknowledgement', $payment))->assertRedirect(route('login'));
});

test('owner can download acknowledgement slip as pdf', function () {
    $owner = User::factory()->create(['email_verified_at' => now()]);
    $payment = createAcknowledgementPayment($owner);

    $response = $this->actingAs($owner)->get(route('payment.acknowledgement', $payment));

    $response->assertOk();
    $response->assertHeader('content-type', 'application/pdf');
});

test('other user cannot download acknowledgement slip', function () {
    $payment = createAcknowledgementPayment();

    $other = User::factory()->create(['email_verified_at' => now()]);

    $this->actingAs($other)->get(route('payment.acknowledgement', $payment))->assertForbidden();
});

test('super admin can download any acknowledgement slip', function () {
    $payment = createAcknowledgementPayment();

    $admin = User::factory()->create([
        'email_verified_at' => now(),
        'role' => RoleEnum::SuperAdmin->value,
    ]);

    $response = $this->actingAs($admin)->get(route('payment.acknowledgement', $payment));

    $response->assertOk();
    $response->assertHeader('content-type', 'application/pdf');
});
