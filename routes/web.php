<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/buku', [BookController::class, 'index'])
    ->name('books.index');

Route::resource('categories', CategoryController::class)->except('show');

Route::resource('users', UserController::class)->except('show');