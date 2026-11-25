<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BorrowingController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

// Route Login
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login']);
});

// Route setelah login
Route::middleware('auth')->group(function () {

    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');

    // Admin dan Petugas
    Route::middleware('role:admin,petugas')->group(function () {

        Route::resource('books', BookController::class);

        // Kategori hanya bisa dilihat
        Route::get('categories', [CategoryController::class, 'index'])
            ->name('categories.index');

        Route::resource('members', MemberController::class);

        Route::resource('borrowings', BorrowingController::class)
            ->only(['index', 'create', 'store', 'show']);

        Route::patch(
            'borrowings/{borrowing}/return',
            [BorrowingController::class, 'returnBook']
        )->name('borrowings.return');
    });

    // Khusus Admin
    Route::middleware('role:admin')->group(function () {

        Route::resource('users', UserController::class)
            ->except('show');

        Route::resource('categories', CategoryController::class)
            ->except(['index', 'show']);
    });
});
