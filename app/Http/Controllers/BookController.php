<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class BookController extends Controller
{
    // 1. LIST BUKU (dengan pencarian, filter, dan pagination)
    public function index(Request $request): View
    {
        $search     = trim($request->string('search')->toString());
        $categoryId = $request->integer('category') ?: null;
        $stock      = $request->string('stock')->toString();

        $books = Book::with('category')
            ->search($search)
            ->inCategory($categoryId)
            ->stockStatus($stock)
            ->orderBy('title')
            ->paginate(10)
            ->withQueryString();

        $categories = Category::orderBy('name')->get();

        return view('books.index', compact('books', 'categories', 'search', 'categoryId', 'stock'));
    }

    // 2. FORM TAMBAH BUKU (+ Pilihan Kategori)
    public function create(): View
    {
        $categories = Category::all();
        return view('books.create', compact('categories'));
    }

    // PROSES SIMPAN BUKU BARU
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title'       => 'required|string|max:255',
            'author'      => 'required|string|max:255',
            'year'        => 'required|digits:4|integer',
            'stock'       => 'required|integer|min:0',
        ]);

        Book::create($validated);

        return redirect()->route('books.index')
            ->with('success', 'Buku berhasil ditambahkan!');
    }

    // 3. DETAIL BUKU
    public function show(Book $book): View
    {
        $book->load('category');
        return view('books.show', compact('book'));
    }

    // 4. FORM EDIT BUKU (+ Pilihan Kategori)
    public function edit(Book $book): View
    {
        $categories = Category::all();
        return view('books.edit', compact('book', 'categories'));
    }

    // PROSES UPDATE BUKU
    public function update(Request $request, Book $book): RedirectResponse
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title'       => 'required|string|max:255',
            'author'      => 'required|string|max:255',
            'year'        => 'required|digits:4|integer',
            'stock'       => 'required|integer|min:0',
        ]);

        $book->update($validated);

        return redirect()->route('books.index')
            ->with('success', 'Data buku berhasil diperbarui!');
    }

    // 5. HAPUS BUKU
    public function destroy(Book $book): RedirectResponse
    {
        $book->delete();

        return redirect()->route('books.index')
            ->with('success', 'Buku berhasil dihapus!');
    }
}