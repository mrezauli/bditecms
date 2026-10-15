<?php

use App\Models\Enrollment;
use App\Models\Payment;
use App\Models\User;
use HasinHayder\Sslcommerz\Data\PaymentResponse;
use HasinHayder\Sslcommerz\Facades\Sslcommerz;
use HasinHayder\Sslcommerz\SslcommerzClient;

function createVerifiedUser(): User
{
    return User::factory()->create(['email_verified_at' => now()]);
}

function createPendingPayment(?User $owner = null, array $overrides = []): Payment
{
    $owner ??= createVerifiedUser();
    $enrollment = Enrollment::factory()->create(['user_id' => $owner->id]);

    return Payment::create(array_merge([
        'enrollment_id' => $enrollment->id,
        'user_id' => $owner->id,
        'amount' => 500.00,
        'transaction_id' => 'TXN'.fake()->unique()->numerify('########'),
        'status' => 'Pending',
        'currency' => 'BDT',
    ], $overrides));
}

function mockGatewayClient(string $gatewayUrl = 'https://pay.sslcommerz.com/abc'): void
{
    $client = Mockery::mock(SslcommerzClient::class);
    $client->shouldReceive('setCustomer')->andReturnSelf();
    $client->shouldReceive('setShippingInfo')->andReturnSelf();
    $client->shouldReceive('makePayment')->andReturn(
        new PaymentResponse(['status' => 'SUCCESS', 'GatewayPageURL' => $gatewayUrl])
    );

    Sslcommerz::shouldReceive('setOrder')->once()->andReturn($client);
}

test('guests cannot initiate payment', function () {
    $enrollment = Enrollment::factory()->create();

    $this->get(route('enrollment.pay', $enrollment))->assertRedirect(route('login'));
});

test('users cannot pay for another user enrollment', function () {
    $enrollment = Enrollment::factory()->create();

    $this->actingAs(createVerifiedUser())
        ->get(route('enrollment.pay', $enrollment))
        ->assertForbidden();
});

test('users cannot pay twice for a completed enrollment', function () {
    $owner = createVerifiedUser();
    $payment = createPendingPayment($owner);
    $payment->update(['status' => 'Complete']);

    $response = $this->actingAs($owner)->get(route('enrollment.pay', $payment->enrollment));

    $response->assertRedirect(route('applied.exams'));
    $response->assertSessionHas('error', __('This exam is already paid.'));
});

test('pay creates a pending payment and redirects to the gateway', function () {
    $owner = createVerifiedUser();
    $enrollment = Enrollment::factory()->create(['user_id' => $owner->id]);

    mockGatewayClient();

    $response = $this->actingAs($owner)->get(route('enrollment.pay', $enrollment));

    $response->assertRedirect('https://pay.sslcommerz.com/abc');

    $this->assertDatabaseHas('payments', [
        'enrollment_id' => $enrollment->id,
        'user_id' => $owner->id,
        'status' => 'Pending',
    ]);
});

test('success callback rejects a tampered hash', function () {
    $payment = createPendingPayment();

    Sslcommerz::shouldReceive('verifyHash')->once()->andReturn(false);

    $response = $this->post(route('sslc.success'), ['tran_id' => $payment->transaction_id]);

    $response->assertRedirect(route('applied.exams'));
    $response->assertSessionHas('error', __('Payment verification failed.'));

    expect($payment->refresh()->status)->toBe('Pending');
});

test('success callback rejects an unknown transaction', function () {
    Sslcommerz::shouldReceive('verifyHash')->once()->andReturn(true);

    $response = $this->post(route('sslc.success'), ['tran_id' => 'TXN-UNKNOWN']);

    $response->assertRedirect(route('applied.exams'));
    $response->assertSessionHas('error', __('Invalid transaction.'));
});

test('success callback is idempotent for completed payments', function () {
    $payment = createPendingPayment();
    $payment->update(['status' => 'Complete']);

    Sslcommerz::shouldReceive('verifyHash')->once()->andReturn(true);

    $response = $this->post(route('sslc.success'), ['tran_id' => $payment->transaction_id]);

    $response->assertRedirect(route('applied.exams'));
    $response->assertSessionHas('success', __('Payment was already processed.'));
});

test('success callback rejects non-pending payments', function () {
    $payment = createPendingPayment();
    $payment->update(['status' => 'Failed']);

    Sslcommerz::shouldReceive('verifyHash')->once()->andReturn(true);

    $response = $this->post(route('sslc.success'), ['tran_id' => $payment->transaction_id]);

    $response->assertRedirect(route('applied.exams'));
    $response->assertSessionHas('error', __('Payment cannot be processed.'));
});

test('success callback rejects an amount mismatch', function () {
    $payment = createPendingPayment();

    Sslcommerz::shouldReceive('verifyHash')->once()->andReturn(true);

    $response = $this->post(route('sslc.success'), [
        'tran_id' => $payment->transaction_id,
        'amount' => '5.00',
    ]);

    $response->assertRedirect(route('applied.exams'));
    $response->assertSessionHas('error', __('Payment verification failed.'));

    expect($payment->refresh()->status)->toBe('Pending');
});

test('success callback completes a valid pending payment', function () {
    $payment = createPendingPayment();

    Sslcommerz::shouldReceive('verifyHash')->once()->andReturn(true);
    Sslcommerz::shouldReceive('validatePayment')->once()->andReturn(true);

    $response = $this->post(route('sslc.success'), [
        'tran_id' => $payment->transaction_id,
        'amount' => '500.00',
        'val_id' => 'VAL123',
        'bank_tran_id' => 'BANK123',
    ]);

    $response->assertRedirect(route('applied.exams'));
    $response->assertSessionHas('success', __('Payment completed successfully.'));

    $payment->refresh();

    expect($payment->status)->toBe('Complete')
        ->and($payment->val_id)->toBe('VAL123')
        ->and($payment->bank_tran_id)->toBe('BANK123');
});

test('success callback fails when gateway validation fails', function () {
    $payment = createPendingPayment();

    Sslcommerz::shouldReceive('verifyHash')->once()->andReturn(true);
    Sslcommerz::shouldReceive('validatePayment')->once()->andReturn(false);

    $response = $this->post(route('sslc.success'), [
        'tran_id' => $payment->transaction_id,
        'amount' => '500.00',
    ]);

    $response->assertRedirect(route('applied.exams'));
    $response->assertSessionHas('error', __('Payment verification failed.'));

    expect($payment->refresh()->status)->toBe('Pending');
});

test('failure callback marks a pending payment failed', function () {
    $payment = createPendingPayment();

    $response = $this->post(route('sslc.failure'), ['tran_id' => $payment->transaction_id]);

    $response->assertRedirect(route('applied.exams'));
    $response->assertSessionHas('error', __('Payment failed. Please try again.'));

    expect($payment->refresh()->status)->toBe('Failed');
});

test('failure callback leaves completed payments untouched', function () {
    $payment = createPendingPayment();
    $payment->update(['status' => 'Complete']);

    $this->post(route('sslc.failure'), ['tran_id' => $payment->transaction_id]);

    expect($payment->refresh()->status)->toBe('Complete');
});

test('cancel callback marks a pending payment canceled', function () {
    $payment = createPendingPayment();

    $response = $this->post(route('sslc.cancel'), ['tran_id' => $payment->transaction_id]);

    $response->assertRedirect(route('applied.exams'));
    $response->assertSessionHas('error', __('Payment was canceled.'));

    expect($payment->refresh()->status)->toBe('Canceled');
});

test('ipn rejects a tampered hash', function () {
    Sslcommerz::shouldReceive('verifyHash')->once()->andReturn(false);

    $this->postJson(route('sslc.ipn'), ['tran_id' => 'TXN-1'])
        ->assertStatus(400)
        ->assertJsonPath('error', 'Hash verification failed');
});

test('ipn rejects a missing transaction id', function () {
    Sslcommerz::shouldReceive('verifyHash')->once()->andReturn(true);

    $this->postJson(route('sslc.ipn'), [])
        ->assertStatus(400)
        ->assertJsonPath('error', 'Missing tran_id');
});

test('ipn reports unknown transactions as not found', function () {
    Sslcommerz::shouldReceive('verifyHash')->once()->andReturn(true);

    $this->postJson(route('sslc.ipn'), ['tran_id' => 'TXN-UNKNOWN'])
        ->assertStatus(404)
        ->assertJsonPath('error', 'Transaction not found');
});

test('ipn acknowledges already completed payments', function () {
    $payment = createPendingPayment();
    $payment->update(['status' => 'Complete']);

    Sslcommerz::shouldReceive('verifyHash')->once()->andReturn(true);

    $this->postJson(route('sslc.ipn'), ['tran_id' => $payment->transaction_id])
        ->assertOk()
        ->assertJsonPath('status', 'already_complete');
});

test('ipn completes a valid pending payment', function () {
    $payment = createPendingPayment();

    Sslcommerz::shouldReceive('verifyHash')->once()->andReturn(true);
    Sslcommerz::shouldReceive('validatePayment')->once()->andReturn(true);

    $this->postJson(route('sslc.ipn'), [
        'tran_id' => $payment->transaction_id,
        'status' => 'VALID',
        'amount' => '500.00',
        'val_id' => 'VAL-IPN',
        'bank_tran_id' => 'BANK-IPN',
    ])
        ->assertOk()
        ->assertJsonPath('received', true);

    $payment->refresh();

    expect($payment->status)->toBe('Complete')
        ->and($payment->val_id)->toBe('VAL-IPN');
});

test('ipn rejects an amount mismatch', function () {
    $payment = createPendingPayment();

    Sslcommerz::shouldReceive('verifyHash')->once()->andReturn(true);

    $this->postJson(route('sslc.ipn'), [
        'tran_id' => $payment->transaction_id,
        'status' => 'VALID',
        'amount' => '5.00',
    ])
        ->assertStatus(400)
        ->assertJsonPath('error', 'Amount mismatch');

    expect($payment->refresh()->status)->toBe('Pending');
});

test('ipn keeps pending payments on non-valid status', function () {
    $payment = createPendingPayment();

    Sslcommerz::shouldReceive('verifyHash')->once()->andReturn(true);

    $this->postJson(route('sslc.ipn'), [
        'tran_id' => $payment->transaction_id,
        'status' => 'FAILED',
    ])
        ->assertOk()
        ->assertJsonPath('received', true);

    expect($payment->refresh()->status)->toBe('Pending');
});
