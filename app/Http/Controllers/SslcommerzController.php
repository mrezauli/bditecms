<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use App\Models\Payment;
use DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Raziul\Sslcommerz\Facades\Sslcommerz;

class SslcommerzController extends Controller
{
    public function payEnrollment(Request $request, Enrollment $enrollment): RedirectResponse
    {
        abort_unless($enrollment->user_id === Auth::id(), 403);

        $existingPayment = $enrollment->payment;
        if ($existingPayment && $existingPayment->status === 'Complete') {
            return redirect()->route('applied.exams')
                ->with('error', __('This exam is already paid.'));
        }

        if ($existingPayment && $existingPayment->status === 'Pending') {
            $payment = $existingPayment;
        } else {
            if ($existingPayment) {
                $existingPayment->delete();
            }

            $transactionId = 'ENROLL-'.$enrollment->id.'-'.uniqid();

            $payment = Payment::create([
                'enrollment_id' => $enrollment->id,
                'user_id' => Auth::id(),
                'amount' => $enrollment->fee,
                'transaction_id' => $transactionId,
                'status' => 'Pending',
                'currency' => 'BDT',
            ]);
        }

        $user = Auth::user();
        $amount = $enrollment->fee;
        $productName = $enrollment->exam->name.' Exam Fee';

        $response = Sslcommerz::setOrder($amount, $payment->transaction_id, $productName)
            ->setCustomer($user->name, $user->email, '', '')
            ->setShippingInfo(1, 'Dhaka')
            ->setProductProfile('digital-goods')
            ->setCallbackUrls(
                route('sslc.enrollment.success'),
                route('sslc.enrollment.failure'),
                route('sslc.enrollment.cancel'),
                route('sslc.enrollment.success'),
            )
            ->makePayment();

        if ($response->success()) {
            return redirect($response->gatewayPageURL());
        }

        return back()->with('error', $response->failedReason());
    }

    public function enrollmentSuccess(Request $request): RedirectResponse
    {
        $tranId = $request->input('tran_id');
        $amount = $request->input('amount');

        $payment = Payment::where('transaction_id', $tranId)->first();

        if (! $payment) {
            return redirect()->route('applied.exams')
                ->with('error', __('Invalid transaction.'));
        }

        if ($payment->status === 'Pending') {
            $validation = Sslcommerz::validatePayment($request->all(), $tranId, $amount);

            if ($validation) {
                $payment->update(['status' => 'Complete']);

                return redirect()->route('applied.exams')
                    ->with('success', __('Payment completed successfully.'));
            }

            return redirect()->route('applied.exams')
                ->with('error', __('Payment verification failed.'));
        }

        return redirect()->route('applied.exams')
            ->with('success', __('Payment was already processed.'));
    }

    public function enrollmentFailure(Request $request): RedirectResponse
    {
        $tranId = $request->input('tran_id');

        $payment = Payment::where('transaction_id', $tranId)->first();

        if ($payment && $payment->status === 'Pending') {
            $payment->update(['status' => 'Failed']);
        }

        return redirect()->route('applied.exams')
            ->with('error', __('Payment failed. Please try again.'));
    }

    public function enrollmentCancel(Request $request): RedirectResponse
    {
        $tranId = $request->input('tran_id');

        $payment = Payment::where('transaction_id', $tranId)->first();

        if ($payment && $payment->status === 'Pending') {
            $payment->update(['status' => 'Canceled']);
        }

        return redirect()->route('applied.exams')
            ->with('error', __('Payment was canceled.'));
    }

    public function success(Request $request)
    {
        $tran_id = $request->input('tran_id');
        $amount = $request->input('amount');

        $order_details = DB::table('orders')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount')->first();

        if ($order_details->status == 'Pending') {
            $validation = Sslcommerz::validatePayment($request->all(), $tran_id, $amount);

            if ($validation) {
                DB::table('orders')
                    ->where('transaction_id', $tran_id)
                    ->update(['status' => 'Processing']);

                echo 'Transaction is successfully Completed';
            }
        } elseif ($order_details->status == 'Processing' || $order_details->status == 'Complete') {
            echo 'Transaction is successfully Completed';
        } else {
            echo 'Invalid Transaction';
        }
    }

    public function failure(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order_details = DB::table('orders')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount')->first();

        if ($order_details->status == 'Pending') {
            DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->update(['status' => 'Failed']);

            echo 'Transaction is Falied';
        } elseif ($order_details->status == 'Processing' || $order_details->status == 'Complete') {
            echo 'Transaction is already Successful';
        } else {
            echo 'Transaction is Invalid';
        }
    }

    public function cancel(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order_details = DB::table('orders')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount')->first();

        if ($order_details->status == 'Pending') {
            DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->update(['status' => 'Canceled']);

            echo 'Transaction is Cancel';
        } elseif ($order_details->status == 'Processing' || $order_details->status == 'Complete') {
            echo 'Transaction is already Successful';
        } else {
            echo 'Transaction is Invalid';
        }
    }

    public function ipn(Request $request)
    {
        if ($request->input('tran_id')) {
            $tran_id = $request->input('tran_id');

            $order_details = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->select('transaction_id', 'status', 'currency', 'amount')->first();

            if ($order_details->status == 'Pending') {
                $validation = Sslcommerz::validatePayment($request->all(), $tran_id, $order_details->amount);

                if ($validation) {
                    DB::table('orders')
                        ->where('transaction_id', $tran_id)
                        ->update(['status' => 'Processing']);

                    echo 'Transaction is successfully Completed';
                }
            } elseif ($order_details->status == 'Processing' || $order_details->status == 'Complete') {
                echo 'Transaction is already successfully Completed';
            } else {
                echo 'Invalid Transaction';
            }
        } else {
            echo 'Invalid Data';
        }
    }

    public function pay()
    {
        $transactionId = uniqid();
        $amount = 50;
        $productName = 'Computer';
        $customerName = 'Customer Name';
        $customerEmail = 'customer@mail.com';
        $customerPhone = '8801XXXXXXXXX';
        $customerAddress = 'Dhaka';

        DB::table('orders')->insert([
            'name' => $customerName,
            'email' => $customerEmail,
            'phone' => $customerPhone,
            'amount' => $amount,
            'status' => 'Pending',
            'address' => $customerAddress,
            'transaction_id' => $transactionId,
            'currency' => 'BDT',
        ]);

        $response = Sslcommerz::setOrder($amount, $transactionId, $productName)
            ->setCustomer($customerName, $customerEmail, $customerPhone, $customerAddress)
            ->setShippingInfo(1, $customerAddress)
            ->setProductProfile('physical-goods')
            ->setCallbackUrls(
                route('sslc.success'),
                route('sslc.failure'),
                route('sslc.cancel'),
                route('sslc.ipn'),
            )
            ->makePayment();

        if ($response->success()) {
            return redirect($response->gatewayPageURL());
        }

        return back()->with('error', $response->failedReason());
    }
}
