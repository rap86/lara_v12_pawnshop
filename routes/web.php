<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FallbackController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/hereafterlogin', function () {
    return view('hereafterlogin');
})->middleware(['auth', 'verified'])->name('hereafterlogin');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::fallback(function () {
    return view('errors.custom-404');
});

require __DIR__.'/auth.php';
