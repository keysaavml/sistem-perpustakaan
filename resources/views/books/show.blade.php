@extends('layouts.app')

@section('title', 'Detail Buku')

@section('content')
<div class="card p-4">
    <table class="table table-borderless">
        <tr><th width="20%">ID Buku</th><td>: {{ $book->id }}</td></tr>
        <tr><th>Judul Buku</th><td>: {{ $book->title }}</td></tr>
        <tr><th>Kategori</th><td>: {{ $book->category->name ?? $book->category->nama_kategori ?? '-' }}</td></tr>
        <tr><th>Penulis</th><td>: {{ $book->author }}</td></tr>
        <tr><th>Tahun Terbit</th><td>: {{ $book->year }}</td></tr>
        <tr><th>Stok</th><td>: {{ $book->stock }} Eksemplar</td></tr>
    </table>
    <div class="mt-3">
        <a href="{{ route('books.index') }}" class="btn btn-secondary">← Kembali</a>
        <a href="{{ route('books.edit', $book->id) }}" class="btn btn-warning">Edit</a>
    </div>
</div>
@endsection