@extends('layouts.app')

@section('title', 'Manajemen Buku')

@section('content')
<div class="card p-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="fw-bold mb-0">Daftar Buku</h5>
        <a href="{{ route('books.create') }}" class="btn btn-primary">+ Tambah Buku</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle text-center">
            <thead class="table-light">
                <tr>
                    <th width="5%">ID</th>
                    <th class="text-start">Judul Buku</th>
                    <th>Penulis</th>
                    <th width="12%">Tahun Terbit</th>
                    <th>Kategori</th>
                    <th width="8%">Stok</th>
                    <th width="22%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($books as $book)
                <tr>
                    <td>{{ $book->id }}</td>
                    <td class="text-start fw-semibold">{{ $book->title }}</td>
                    <td>{{ $book->author }}</td>
                    <td>{{ $book->year }}</td>
                    <td>
                        <span class="badge bg-info text-dark">
                            {{ $book->category->name ?? $book->category->nama_kategori ?? 'Tanpa Kategori' }}
                        </span>
                    </td>
                    <td>{{ $book->stock }}</td>
                    <td>
                        <div class="d-flex justify-content-center gap-1">
                            <a href="{{ route('books.show', $book->id) }}" class="btn btn-sm btn-info text-white">Detail</a>
                            <a href="{{ route('books.edit', $book->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('books.destroy', $book->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus buku ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-muted py-4">Belum ada data buku.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection