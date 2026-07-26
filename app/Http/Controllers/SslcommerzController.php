<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Raziul\Sslcommerz\Facades\Sslcommerz;

class SslcommerzController extends Controller
{
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
