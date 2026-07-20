<?php

use App\Http\Controllers\Auth\ExamineeController;
use App\Http\Controllers\SslcommerzController;
use App\Http\Controllers\SslCommerzPaymentController;
use App\Livewire\AppliedExams;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

// SSLCOMMERZ Start
Route::get('/example1', [SslCommerzPaymentController::class, 'exampleEasyCheckout']);
Route::get('/example2', [SslCommerzPaymentController::class, 'exampleHostedCheckout']);

Route::post('/pay', [SslCommerzPaymentController::class, 'index']);
Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);

Route::post('/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
//SSLCOMMERZ END

Route::get('/pay', [SslCommerzPaymentController::class, 'pay']);

Route::controller(SslcommerzController::class)
    ->prefix('sslcommerz') // prefix to avoid conflicts
    ->name('sslc.')
    ->group(function () {
        Route::post('success', 'success')->name('success');
        Route::post('failure', 'failure')->name('failure');
        Route::post('cancel', 'cancel')->name('cancel');
        Route::post('ipn', 'ipn')->name('ipn');
    });

Route::post('/examinee/validate', [ExamineeController::class, 'validate'])
    ->name('examinee.validate');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');

    Route::livewire('dashboard/applied-exams', AppliedExams::class)
        ->name('applied.exams');
});



require __DIR__ . '/settings.php';
