<?php

use App\Http\Controllers\CustomersController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\BackupsController;
use Illuminate\Support\Facades\Route;

// 1. Guest / Public Access
Route::get('/', function () {
    return view('welcome');
});

// 2. Protected Routes (Everything requiring a logged-in user)
Route::middleware(['auth', 'verified'])->group(function () {

    // Redirection / Landing Pages
    Route::get('/hereafterlogin', function () {
        return view('hereafterlogin');
    })->name('hereafterlogin');

    Route::get('/login_page', function () {
        return view('login_page');
    })->name('login_page');

    // Users Management
    Route::get('/users', [UsersController::class, 'index'])->name('users.index');
    Route::post('/users', [UsersController::class, 'store'])->name('users.store');
    Route::put('/users/{id}', [UsersController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}', [UsersController::class, 'destroy'])->name('users.destroy');

    // Customers Management (Moved inside auth for safety!)
    Route::resource('customers', CustomersController::class);


    // Protect this route with auth middleware so regular guests can't extract your database info!
    Route::get('/database/download', [BackupsController::class, 'download_database'])
        ->middleware('auth')
        ->name('database.download');

});


// 3. System Fallback & Auth files
// 404 is a Global Fallback, Not a Protected Route
Route::fallback(function () {
    return view('errors.custom-404');
});

require __DIR__.'/auth.php';
