<?php

use App\Http\Controllers\CustomersController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\BackupsController;
use App\Http\Controllers\PrintsController;
use App\Http\Controllers\DashboardsController;
use App\Http\Controllers\BranchesController;
use App\Http\Controllers\BranchSessionsController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\AjaxChatController;
use Illuminate\Support\Facades\Route;

// 1. Guest / Public Access
Route::get('/', function () {
    return view('welcome');
});

// 2. Protected Routes (Everything requiring a logged-in user)
Route::middleware(['auth', 'verified'])->group(function () {

    // =========================================================================
    // OPEN FOR 2FA INPUT (Must not have 'auth.2fa' to prevent infinite loops)
    // =========================================================================
    Route::get('/settings/input_code', [SettingsController::class, 'show'])->name('settings.show');
    Route::post('/settings/input_validation', [SettingsController::class, 'input_validation'])->name('settings.input_validation');

    Route::get('/login_page', function () {
        return view('login_page');
    })->name('login_page');


    // =========================================================================
    // SECURED INTERNAL PAWNSHOP PAGES (Protected by the 'auth.2fa' middleware guard)
    // =========================================================================
    Route::middleware(['auth.2fa'])->group(function () {

        // Redirection / Landing Pages
        Route::get('/hereafterlogin', function () {
            return view('hereafterlogin');
        })->name('hereafterlogin');

        // Users Management
        Route::get('/users', [UsersController::class, 'index'])->name('users.index');
        Route::get('/users/create', [UsersController::class, 'create'])->name('users.create');
        Route::post('/users', [UsersController::class, 'store'])->name('users.store');
        Route::get('/users/{id}', [UsersController::class, 'edit'])->name('users.edit');
        Route::put('/users/{id}', [UsersController::class, 'update'])->name('users.update');
        Route::delete('/users/{id}', [UsersController::class, 'destroy'])->name('users.destroy');

        // Branch Management
        Route::get('/branches', [BranchesController::class, 'index'])->name('branches.index');
        Route::post('/branches', [BranchesController::class, 'store'])->name('branches.store');
        Route::put('/branches/{id}', [BranchesController::class, 'update'])->name('branches.update');
        Route::delete('/branches/{id}', [BranchesController::class, 'destroy'])->name('branches.destroy');

        // Settings Management
        Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');

        Route::post('/settings', [SettingsController::class, 'store'])->name('settings.store');
        Route::put('/settings/{id}', [SettingsController::class, 'update'])->name('settings.update');
        Route::delete('/settings/{id}', [SettingsController::class, 'destroy'])->name('settings.destroy');

        // Customers Management

        Route::get('/customers', [CustomersController::class, 'index'])->name('customers.index');
        Route::post('/customers', [CustomersController::class, 'store'])->name('customers.store');
        Route::put('/customers/{id}', [CustomersController::class, 'edit'])->name('customers.edit');
        Route::put('/customers/{id}', [CustomersController::class, 'update'])->name('customers.update');
        Route::delete('/customers/{id}', [CustomersController::class, 'destroy'])->name('customers.destroy');

        Route::get('/customers/search', [CustomersController::class, 'search'])->name('customers.search');
        Route::resource('customers', CustomersController::class);


        // Database Backup Route
        Route::get('/database/download', [BackupsController::class, 'download_database'])->name('database.download');

        Route::get('/print_customer_info', [PrintsController::class, 'print_customer_info'])->name('prints.print_customer_info');

        Route::get('/dashboard', [DashboardsController::class, 'index'])->name('dashboards.index');

        Route::post('/switch-branch', [BranchSessionsController::class, 'switch'])->name('branch.switch');


    });

		// 🌟 Add this line to map the primary chat dashboard URL path
		Route::get('/chat', [AjaxChatController::class, 'showChat'])->name('chat.index');
		Route::post('/ajax-chat/send', [AjaxChatController::class, 'sendMessage'])->name('ajax.chat.send');
		Route::get('/ajax-chat/fetch-new', [AjaxChatController::class, 'fetchNewMessages'])->name('ajax.chat.fetch');
        Route::get('/ajax-chat/notifications', [AjaxChatController::class, 'fetchUnreadNotifications'])->name('ajax.chat.notifications');
        Route::post('/ajax-chat/mark-as-read', [AjaxChatController::class, 'markAsRead'])->name('ajax.chat.markAsRead');


});

// 3. System Fallback & Auth files
Route::fallback(function () {
    return view('errors.custom-404');
});

require __DIR__.'/auth.php';
