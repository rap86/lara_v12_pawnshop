<?php

use App\Http\Controllers\CustomersController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsersController;
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

Route::get('/login_page', function () {
    return view('login_page');
})->middleware(['auth', 'verified'])->name('login_page');

Route::resource('/customers', CustomersController::class);

Route::middleware(['auth', 'verified'])->group(function () {
    // Keep your existing index route, and add the POST store method right underneath it:
    Route::get('/users', [UsersController::class, 'index'])->name('users.index');
    Route::post('/users', [UsersController::class, 'store'])->name('users.store');
    Route::put('/users/{id}', [UsersController::class, 'update'])->name('users.update');

});

Route::fallback(function () {
    return view('errors.custom-404');
});

require __DIR__.'/auth.php';
