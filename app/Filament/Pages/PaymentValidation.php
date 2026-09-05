<?php

namespace App\Filament\Pages;

use App\Models\Payment;
use BackedEnum;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use HasinHayder\Sslcommerz\Facades\Sslcommerz;
use Illuminate\Support\Facades\Log;
use UnitEnum;

class PaymentValidation extends Page
{
    protected string $view = 'filament.pages.payment-validation';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::ShieldCheck;

    protected static string|UnitEnum|null $navigationGroup = 'Payment';

    protected static ?string $navigationLabel = 'Payment Validation';

    protected static ?int $navigationSort = 2;

    protected static ?string $title = 'Payment Validation';

    public ?string $transactionId = null;

    public ?Payment $foundPayment = null;

    public ?array $gatewayResult = null;

    public ?string $validationMessage = null;

    public ?string $validationStatus = null; // success|error|warning

    public function mount(): void
    {
        $this->transactionId = request()->query('transaction_id');
        if ($this->transactionId) {
            $this->validatePayment();
        }
    }

    public function validatePayment(): void
    {
        $this->validate([
            'transactionId' => ['required', 'string', 'max:255'],
        ]);

        $this->foundPayment = Payment::where('transaction_id', $this->transactionId)
            ->with(['user', 'enrollment.exam', 'enrollment.type'])
            ->first();

        if (! $this->foundPayment) {
            $this->validationStatus = 'error';
            $this->validationMessage = 'No payment found for transaction ID: '.$this->transactionId;
            $this->gatewayResult = null;

            Notification::make()
                ->title('Payment not found')
                ->body($this->validationMessage)
                ->danger()
                ->send();

            return;
        }

        $payment = $this->foundPayment;

        // Basic compliance checks (offline)
        $expectedFee = $payment->enrollment?->fee;
        $amountMatches = $expectedFee === null || abs((float) $payment->amount - (float) $expectedFee) < 0.01;
        $hasValId = (bool) $payment->val_id;

        // Attempt gateway validation if we have val_id
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

                    Notification::make()
                        ->title('Gateway validation successful')
                        ->body($this->validationMessage)
                        ->success()
                        ->send();
                } else {
                    $this->validationStatus = 'error';
                    $this->validationMessage = 'Gateway validation failed: transaction '.$payment->transaction_id.' is INVALID for '.number_format((float) $payment->amount, 2).' '.$payment->currency.'.';

                    Notification::make()
                        ->title('Gateway validation failed')
                        ->body($this->validationMessage)
                        ->danger()
                        ->send();
                }
            } catch (\Throwable $e) {
                Log::error('PaymentValidation gateway error', ['transaction_id' => $payment->transaction_id, 'error' => $e->getMessage()]);
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

            Notification::make()
                ->title('Pending')
                ->body($this->validationMessage)
                ->warning()
                ->send();
        }
    }

    public function clear(): void
    {
        $this->transactionId = null;
        $this->foundPayment = null;
        $this->gatewayResult = null;
        $this->validationMessage = null;
        $this->validationStatus = null;
    }
}
