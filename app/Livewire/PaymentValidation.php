<?php

namespace App\Livewire;

use App\Models\Payment;
use HasinHayder\Sslcommerz\Facades\Sslcommerz;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;

#[Title('Payment Validation')]
class PaymentValidation extends Component
{
    #[Url]
    public ?string $transactionId = null;

    public ?Payment $foundPayment = null;

    public ?array $gatewayResult = null;

    public ?string $validationMessage = null;

    public ?string $validationStatus = null;

    public function validatePayment(): void
    {
        $this->validate([
            'transactionId' => ['required', 'string', 'max:255'],
        ]);

        $this->foundPayment = Payment::where('transaction_id', $this->transactionId)
            ->where('user_id', Auth::id())
            ->with(['user', 'enrollment.exam', 'enrollment.type'])
            ->first();

        if (! $this->foundPayment) {
            $this->validationStatus = 'error';
            $this->validationMessage = 'No payment found for your account with transaction ID: '.$this->transactionId;
            $this->gatewayResult = null;

            return;
        }

        $payment = $this->foundPayment;
        $expectedFee = $payment->enrollment?->fee;
        $amountMatches = $expectedFee === null || abs((float) $payment->amount - (float) $expectedFee) < 0.01;
        $hasValId = (bool) $payment->val_id;

        if ($hasValId) {
            try {
                $payload = ['val_id' => $payment->val_id];
                $valid = Sslcommerz::validatePayment($payload, $payment->transaction_id, $payment->amount, $payment->currency);

                $this->gatewayResult = [
                    'gateway_valid' => $valid,
                    'val_id' => $payment->val_id,
                    'bank_tran_id' => $payment->bank_tran_id,
                    'amount' => $payment->amount,
                    'currency' => $payment->currency,
                    'status' => $payment->status,
                ];

                if ($valid) {
                    $this->validationStatus = 'success';
                    $this->validationMessage = 'Gateway validated: transaction '.$payment->transaction_id.' is VALID for '.number_format((float) $payment->amount, 2).' '.$payment->currency.'.';

                    if ($payment->status !== 'Complete' && $amountMatches) {
                        $payment->update(['status' => 'Complete']);
                    }
                } else {
                    $this->validationStatus = 'error';
                    $this->validationMessage = 'Gateway validation failed: transaction '.$payment->transaction_id.' is INVALID for '.number_format((float) $payment->amount, 2).' '.$payment->currency.'.';
                }
            } catch (\Throwable $e) {
                Log::error('Candidate PaymentValidation gateway error', ['transaction_id' => $payment->transaction_id, 'error' => $e->getMessage()]);
                $this->validationStatus = 'error';
                $this->validationMessage = 'Gateway error: '.$e->getMessage();
                $this->gatewayResult = null;
            }
        } else {
            $this->validationStatus = 'warning';
            $this->validationMessage = 'Payment pending: transaction '.$payment->transaction_id.' is '.$payment->status.' for '.number_format((float) $payment->amount, 2).' '.$payment->currency.'.';
            $this->gatewayResult = [
                'gateway_valid' => null,
                'status' => $payment->status,
            ];
        }
    }

    public function clear(): void
    {
        $this->reset(['transactionId', 'foundPayment', 'gatewayResult', 'validationMessage', 'validationStatus']);
        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.payment-validation');
    }
}
