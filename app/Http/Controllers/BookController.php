<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\View\View;

class BookController extends Controller
{
    public function index(): View
    {
        $books = Book::with('category')
            ->orderBy('title')
            ->get();

        return view('books.index', compact('books'));
    }
}
