<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use App\Models\Payment;
use HasinHayder\Sslcommerz\Facades\Sslcommerz;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class SslcommerzController extends Controller
{
    /**
     * Initiate payment for an enrollment.
     * Fee compliance: IP 500, FE half 500, FE both 1000 (Enrollment::fee).
     */
    public function payEnrollment(Request $request, Enrollment $enrollment): RedirectResponse
    {
        abort_unless($enrollment->user_id === Auth::id(), 403);

        // Eager load needed relations for fee calculation
        $enrollment->loadMissing(['exam', 'type']);

        $amount = $enrollment->fee;

        // Compliance guard: only 500 or 1000 allowed
        if (! in_array($amount, [500.00, 1000.00], true) && ! in_array((float) $amount, [500.0, 1000.0], true)) {
            Log::warning('Invalid fee amount for enrollment', [
                'enrollment_id' => $enrollment->id,
                'amount' => $amount,
            ]);

            return back()->with('error', __('Invalid payment amount.'));
        }

        $existing = $enrollment->payment;

        if ($existing && $existing->status === 'Complete') {
            return redirect()->route('applied.exams')
                ->with('error', __('This exam is already paid.'));
        }

        // Reuse pending payment, otherwise create fresh transaction
        if ($existing && $existing->status === 'Pending') {
            $payment = $existing;
        } else {
            if ($existing) {
                $existing->delete();
            }

            $transactionId = 'ENROLL-'.$enrollment->id.'-'.strtoupper(Str::random(10));

            $payment = Payment::create([
                'enrollment_id' => $enrollment->id,
                'user_id' => Auth::id(),
                'amount' => $amount,
                'transaction_id' => $transactionId,
                'status' => 'Pending',
                'currency' => 'BDT',
            ]);
        }

        $user = Auth::user();
        $productName = $enrollment->exam->name.' Exam Fee';

        // Store context for success callback (session-based reconciliation)
        session([
            'sslc_enrollment_id' => $enrollment->id,
            'sslc_user_id' => $user->id,
            'sslc_transaction_id' => $payment->transaction_id,
        ]);

        try {
            $response = Sslcommerz::setOrder($payment->amount, $payment->transaction_id, $productName)
                ->setCustomer($user->name, $user->email)
                ->setShippingInfo(1, 'Dhaka, Bangladesh')
                ->makePayment();

            if ($response->success()) {
                return redirect($response->gatewayPageURL());
            }

            Log::error('SSLCommerz initiation failed', [
                'enrollment_id' => $enrollment->id,
                'transaction_id' => $payment->transaction_id,
                'status' => $response->status(),
                'reason' => $response->failedReason(),
            ]);

            return back()->with('error', $response->failedReason() ?: __('Payment initiation failed. Please try again.'));
        } catch (\Throwable $e) {
            Log::error('SSLCommerz exception on initiation', [
                'enrollment_id' => $enrollment->id,
                'transaction_id' => $payment->transaction_id,
                'error' => $e->getMessage(),
            ]);

            return back()->with('error', __('Connection error. Please try again.'));
        }
    }

    public function enrollmentSuccess(Request $request): RedirectResponse
    {
        // 1. Hash verification – prevents tampered POST
        if (! Sslcommerz::verifyHash($request->all())) {
            Log::warning('SSLCommerz hash verification failed (success)', $request->all());

            return redirect()->route('applied.exams')
                ->with('error', __('Payment verification failed.'));
        }

        $tranId = $request->input('tran_id');
        $amount = $request->input('amount');

        $payment = Payment::where('transaction_id', $tranId)->first();

        if (! $payment) {
            Log::warning('Payment not found for transaction', ['tran_id' => $tranId]);

            return redirect()->route('applied.exams')
                ->with('error', __('Invalid transaction.'));
        }

        // Idempotency: already completed
        if ($payment->status === 'Complete') {
            session()->forget(['sslc_enrollment_id', 'sslc_user_id', 'sslc_transaction_id']);

            return redirect()->route('applied.exams')
                ->with('success', __('Payment was already processed.'));
        }

        // Only pending payments should be validated
        if ($payment->status !== 'Pending') {
            return redirect()->route('applied.exams')
                ->with('error', __('Payment cannot be processed.'));
        }

        // 2. Strict amount compliance check before remote validation
        if (abs((float) $payment->amount - (float) $amount) >= 1) {
            Log::warning('Amount mismatch on success callback', [
                'tran_id' => $tranId,
                'expected' => $payment->amount,
                'received' => $amount,
            ]);

            return redirect()->route('applied.exams')
                ->with('error', __('Payment verification failed.'));
        }

        // 3. Remote validation via SSLCommerz
        $validated = Sslcommerz::validatePayment($request->all(), $tranId, $payment->amount);

        if (! $validated) {
            Log::warning('SSLCommerz validatePayment failed', ['tran_id' => $tranId]);

            return redirect()->route('applied.exams')
                ->with('error', __('Payment verification failed.'));
        }

        // 4. Session context sanity (defense-in-depth, not required but logged)
        $sessionEnrollmentId = session('sslc_enrollment_id');
        if ($sessionEnrollmentId && (int) $sessionEnrollmentId !== (int) $payment->enrollment_id) {
            Log::warning('Session enrollment mismatch', [
                'session_enrollment' => $sessionEnrollmentId,
                'payment_enrollment' => $payment->enrollment_id,
                'tran_id' => $tranId,
            ]);
        }

        $payment->update([
            'status' => 'Complete',
            'val_id' => $request->input('val_id'),
            'bank_tran_id' => $request->input('bank_tran_id'),
        ]);

        session()->forget(['sslc_enrollment_id', 'sslc_user_id', 'sslc_transaction_id']);

        return redirect()->route('applied.exams')
            ->with('success', __('Payment completed successfully.'));
    }

    public function enrollmentFailure(Request $request): RedirectResponse
    {
        $tranId = $request->input('tran_id');

        $payment = $tranId ? Payment::where('transaction_id', $tranId)->first() : null;

        if ($payment && $payment->status === 'Pending') {
            $payment->update(['status' => 'Failed']);
        }

        Log::warning('SSLCommerz payment failed', $request->all());
        session()->forget(['sslc_enrollment_id', 'sslc_user_id', 'sslc_transaction_id']);

        return redirect()->route('applied.exams')
            ->with('error', __('Payment failed. Please try again.'));
    }

    public function enrollmentCancel(Request $request): RedirectResponse
    {
        $tranId = $request->input('tran_id');

        $payment = $tranId ? Payment::where('transaction_id', $tranId)->first() : null;

        if ($payment && $payment->status === 'Pending') {
            $payment->update(['status' => 'Canceled']);
        }

        Log::info('SSLCommerz payment cancelled', $request->all());
        session()->forget(['sslc_enrollment_id', 'sslc_user_id', 'sslc_transaction_id']);

        return redirect()->route('applied.exams')
            ->with('error', __('Payment was canceled.'));
    }

    /**
     * IPN – server-to-server notification. Must return JSON, never redirect.
     */
    public function ipn(Request $request): JsonResponse
    {
        if (! Sslcommerz::verifyHash($request->all())) {
            Log::warning('SSLCommerz IPN hash verification failed', $request->all());

            return response()->json(['error' => 'Hash verification failed'], 400);
        }

        $tranId = $request->input('tran_id');
        $status = $request->input('status');

        if (! $tranId) {
            return response()->json(['error' => 'Missing tran_id'], 400);
        }

        $payment = Payment::where('transaction_id', $tranId)->first();

        if (! $payment) {
            Log::warning('IPN for unknown transaction', ['tran_id' => $tranId]);

            return response()->json(['error' => 'Transaction not found'], 404);
        }

        if ($payment->status === 'Complete') {
            return response()->json(['received' => true, 'status' => 'already_complete'], 200);
        }

        // Only VALID / VALIDATED should mark as complete, after remote validation
        if (in_array($status, ['VALID', 'VALIDATED'], true) && $payment->status === 'Pending') {
            // Optional amount check if provided
            $amount = $request->input('amount');
            if ($amount && abs((float) $amount - (float) $payment->amount) >= 1) {
                Log::warning('IPN amount mismatch', [
                    'tran_id' => $tranId,
                    'expected' => $payment->amount,
                    'received' => $amount,
                ]);

                return response()->json(['error' => 'Amount mismatch'], 400);
            }

            $validated = Sslcommerz::validatePayment($request->all(), $tranId, $payment->amount);

            if ($validated) {
                $payment->update([
                    'status' => 'Complete',
                    'val_id' => $request->input('val_id', $payment->val_id),
                    'bank_tran_id' => $request->input('bank_tran_id', $payment->bank_tran_id),
                ]);

                Log::info('IPN payment completed', ['tran_id' => $tranId]);

                return response()->json(['received' => true], 200);
            }

            Log::warning('IPN validatePayment failed', ['tran_id' => $tranId]);

            return response()->json(['error' => 'Validation failed'], 400);
        }

        // For FAILED/CANCELLED/etc we keep Pending until user retries; log only
        Log::info('IPN received non-VALID status', ['tran_id' => $tranId, 'status' => $status]);

        return response()->json(['received' => true], 200);
    }
}
