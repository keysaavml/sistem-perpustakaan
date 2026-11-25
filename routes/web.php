<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('categories', CategoryController::class)->except('show');
Route::resource('books', BookController::class);
Route::resource('users', UserController::class)->except('show');

// Route Logout (bisa dihapus nanti kalo si key udah menggabungkan kode auth miliknya)
Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/login');
})->name('logout');