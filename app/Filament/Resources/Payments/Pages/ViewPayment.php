<?php

namespace App\Filament\Resources\Payments\Pages;

use App\Filament\Resources\Payments\PaymentResource;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ViewRecord;
use HasinHayder\Sslcommerz\Facades\Sslcommerz;
use Illuminate\Support\Facades\Log;

class ViewPayment extends ViewRecord
{
    protected static string $resource = PaymentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('downloadAcknowledgement')
                ->label('Acknowledgement Slip (PDF)')
                ->icon('heroicon-o-document-arrow-down')
                ->color('success')
                ->url(fn () => route('payment.acknowledgement', $this->record))
                ->openUrlInNewTab(),
            Action::make('validateGateway')
                ->label('Validate via Gateway')
                ->icon('heroicon-o-shield-check')
                ->color('info')
                ->requiresConfirmation()
                ->action(function () {
                    $payment = $this->record;

                    if (! $payment->val_id) {
                        Notification::make()
                            ->title('No gateway validation data')
                            ->body('This payment has no val_id yet (pending before gateway callback). Cannot call validator API.')
                            ->warning()
                            ->send();

                        return;
                    }

                    // Simulate payload for validatePayment – gateway needs val_id
                    $payload = ['val_id' => $payment->val_id];
                    $valid = Sslcommerz::validatePayment($payload, $payment->transaction_id, $payment->amount, $payment->currency);

                    if ($valid) {
                        if ($payment->status !== 'Complete') {
                            $payment->update(['status' => 'Complete']);
                        }

                        Notification::make()
                            ->title('Payment validated')
                            ->body('Gateway confirmed transaction '.$payment->transaction_id.' amount '.$payment->amount.' is valid.')
                            ->success()
                            ->send();
                    } else {
                        Log::warning('Manual payment validation failed', ['transaction_id' => $payment->transaction_id]);

                        Notification::make()
                            ->title('Validation failed')
                            ->body('Gateway could not validate this transaction. Check amount/currency or try again.')
                            ->danger()
                            ->send();
                    }
                }),
        ];
    }
}
