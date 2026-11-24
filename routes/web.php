<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/buku', [BookController::class, 'index'])
    ->name('books.index');

Route::resource('categories', CategoryController::class)->except('show');
Route::resource('books', BookController::class);