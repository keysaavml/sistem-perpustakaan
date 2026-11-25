
<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BorrowingController;
use Illuminate\Support\Facades\Route;

// Route untuk login
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// Route yang hanya bisa diakses setelah login
Route::middleware('auth')->group(function () {

    Route::get('/', fn () => redirect()->route('books.index'));

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::resource('books', BookController::class);

    Route::resource('categories', CategoryController::class)->except('show');

    Route::resource('users', UserController::class)->except('show');

    // Route khusus admin dan petugas
    Route::middleware(['role:admin,petugas'])->group(function () {

        Route::resource('members', MemberController::class);

        Route::resource('borrowings', BorrowingController::class)
            ->only(['index', 'create', 'store', 'show']);

        Route::patch('borrowings/{borrowing}/return', [BorrowingController::class, 'returnBook'])
            ->name('borrowings.return');
    });
});
