<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BorrowingController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('categories', CategoryController::class)->except('show');

Route::resource('books', BookController::class);

Route::resource('users', UserController::class)->except('show');

Route::middleware(['auth', 'role:admin,petugas'])->group(function () {
    Route::resource('members', MemberController::class);

    Route::resource('borrowings', BorrowingController::class)
        ->only(['index', 'create', 'store', 'show']);

    Route::patch('borrowings/{borrowing}/return', [BorrowingController::class, 'returnBook'])
        ->name('borrowings.return');
});