@extends('layouts.app')

@section('title', 'Edit Data Buku')

@section('content')
<div class="card p-4">
    <form action="{{ route('books.update', $book->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row g-3">
            <div class="col-md-8">
                <label class="form-label fw-semibold">Judul Buku</label>
                <input type="text" name="title" class="form-control" value="{{ old('title', $book->title) }}" required>
            </div>
            <div class="col-md-4">
                <label class="form-label fw-semibold">Kategori</label>
                <select name="category_id" class="form-select" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $book->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name ?? $category->nama_kategori }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-semibold">Penulis</label>
                <input type="text" name="author" class="form-control" value="{{ old('author', $book->author) }}" required>
            </div>
            <div class="col-md-3">
                <label class="form-label fw-semibold">Tahun Terbit</label>
                <input type="number" name="year" class="form-control" value="{{ old('year', $book->year) }}" required>
            </div>
            <div class="col-md-3">
                <label class="form-label fw-semibold">Stok</label>
                <input type="number" name="stock" class="form-control" value="{{ old('stock', $book->stock) }}" min="0" required>
            </div>
            <div class="col-12 text-end mt-3">
                <a href="{{ route('books.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-warning">Update Buku</button>
            </div>
        </div>
    </form>
</div>
@endsection