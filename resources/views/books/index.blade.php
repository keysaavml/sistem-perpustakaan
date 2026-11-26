@extends('layouts.app')

@section('title', 'Manajemen Buku')

@section('content')
<div class="card p-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="fw-bold mb-0">Daftar Buku</h5>

        <a href="{{ route('books.create') }}" class="btn btn-primary">
            + Tambah Buku
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Form pencarian & filter --}}
    <form method="GET" action="{{ route('books.index') }}" class="row g-2 mb-3">
        <div class="col-md-5">
            <input type="text"
                   name="search"
                   class="form-control"
                   placeholder="Cari judul, penulis, tahun, atau kategori..."
                   value="{{ $search }}">
        </div>

        <div class="col-md-3">
            <select name="category" class="form-select">
                <option value="">Semua Kategori</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ (int) $categoryId === $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-2">
            <select name="stock" class="form-select">
                <option value="">Semua Stok</option>
                <option value="available" {{ $stock === 'available' ? 'selected' : '' }}>Tersedia</option>
                <option value="empty" {{ $stock === 'empty' ? 'selected' : '' }}>Habis</option>
            </select>
        </div>

        <div class="col-md-2 d-flex gap-1">
            <button type="submit" class="btn btn-primary flex-fill">Cari</button>
            <a href="{{ route('books.index') }}" class="btn btn-outline-secondary flex-fill">Reset</a>
        </div>
    </form>

    @if($search !== '' || $categoryId || $stock !== '')
        <p class="text-muted small mb-3">
            Ditemukan <strong>{{ $books->total() }}</strong> buku
            @if($search !== '')
                untuk kata kunci "<strong>{{ $search }}</strong>"
            @endif
        </p>
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

                        <td class="text-start fw-semibold">
                            {{ $book->title }}
                        </td>

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
                                <a href="{{ route('books.show', $book->id) }}"
                                   class="btn btn-sm btn-info text-white">
                                    Detail
                                </a>

                                <a href="{{ route('books.edit', $book->id) }}"
                                   class="btn btn-sm btn-warning">
                                    Edit
                                </a>

                                <form action="{{ route('books.destroy', $book->id) }}"
                                      method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus buku ini?')">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-sm btn-danger">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-muted py-4">
                            @if($search !== '' || $categoryId || $stock !== '')
                                Tidak ada buku yang cocok dengan pencarian Anda.
                            @else
                                Belum ada data buku.
                            @endif
                        </td>
                    </tr>
                @endforelse
            </tbody>

        </table>
    </div>

    <div class="d-flex justify-content-between align-items-center mt-3">
        <small class="text-muted">
            @if($books->total() > 0)
                Menampilkan {{ $books->firstItem() }}-{{ $books->lastItem() }} dari {{ $books->total() }} buku
            @endif
        </small>

        {{ $books->links() }}
    </div>

</div>
@endsection