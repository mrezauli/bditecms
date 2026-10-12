<?php

namespace App\Http\Controllers;

use App\Enums\RoleEnum;
use App\Models\Payment;
use Spatie\LaravelPdf\Facades\Pdf;

class PaymentAcknowledgementController extends Controller
{
    public function __invoke(Payment $payment)
    {
        $user = auth()->user();

        if ((int) $payment->user_id !== (int) $user->id && $user->role !== RoleEnum::SuperAdmin) {
            abort(403);
        }

        $payment->load(['enrollment.exam', 'enrollment.type', 'enrollment.site', 'enrollment.intake', 'user.profile']);

        return Pdf::view('payments.acknowledgement-slip', ['payment' => $payment])
            ->format('a4')
            ->name('acknowledgement-'.$payment->transaction_id.'.pdf');
    }
}
