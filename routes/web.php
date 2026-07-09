<?php

use App\Http\Controllers\Auth\ExamineeController;
use App\Livewire\AppliedExams;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::post('/examinee/validate', [ExamineeController::class, 'validate'])
    ->name('examinee.validate');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');

    Route::livewire('dashboard/applied-exams', AppliedExams::class)
        ->name('applied.exams');
});

require __DIR__.'/settings.php';
