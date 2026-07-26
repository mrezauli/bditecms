<?php

use App\Http\Controllers\Auth\ExamineeController;
use App\Http\Controllers\SslcommerzController;
use App\Livewire\AppliedExams;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::get('/pay', [SslcommerzController::class, 'pay']);

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

require __DIR__.'/settings.php';
