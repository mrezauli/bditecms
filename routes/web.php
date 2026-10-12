<?php

use App\Http\Controllers\Auth\ExamineeController;
use App\Http\Controllers\Auth\RegisterPreviewController;
use App\Http\Controllers\PaymentAcknowledgementController;
use App\Http\Controllers\SslcommerzController;
use App\Http\Middleware\VerifyCsrfToken;
use App\Livewire\AppliedExams;
use App\Livewire\Issues\Dashboard as IssuesDashboard;
use App\Livewire\PaymentDetails;
use App\Livewire\PaymentValidation;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::post('/examinee/validate', [ExamineeController::class, 'validate'])
    ->name('examinee.validate');

// Registration preview (guest) – must be defined before Fortify's register routes take precedence for POST
Route::middleware(['guest'])->group(function () {
    Route::post('/register/preview', [RegisterPreviewController::class, 'preview'])->name('register.preview');
    Route::get('/register/preview', [RegisterPreviewController::class, 'show'])->name('register.preview.show');
    Route::post('/register/preview/back', [RegisterPreviewController::class, 'back'])->name('register.preview.back');
    Route::post('/register/confirm', [RegisterPreviewController::class, 'confirm'])->name('register.confirm');
});

// SSLCommerz callbacks – must be without CSRF (server-to-server POST)
Route::controller(SslcommerzController::class)
    ->prefix('sslcommerz')
    ->name('sslc.')
    ->withoutMiddleware([VerifyCsrfToken::class])
    ->group(function () {
        Route::post('success', 'enrollmentSuccess')->name('success');
        Route::post('failure', 'enrollmentFailure')->name('failure');
        Route::post('cancel', 'enrollmentCancel')->name('cancel');
        Route::post('ipn', 'ipn')->name('ipn');
    });

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard/payments/{payment}/acknowledgement', PaymentAcknowledgementController::class)
        ->name('payment.acknowledgement');
});

Route::middleware(['auth', 'verified', 'role:user'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');

    Route::livewire('dashboard/applied-exams', AppliedExams::class)
        ->name('applied.exams');

    Route::livewire('dashboard/payment-details', PaymentDetails::class)
        ->name('payment.details');

    Route::livewire('dashboard/payment-validation', PaymentValidation::class)
        ->name('payment.validation');

    Route::get('enrollment/{enrollment}/pay', [SslcommerzController::class, 'payEnrollment'])
        ->name('enrollment.pay');

    Route::livewire('issues', IssuesDashboard::class)
        ->name('issues');
});

require __DIR__.'/settings.php';
