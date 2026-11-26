<<<<<<< HEAD

<h1>Daftar Kategori</h1>
=======
@extends('layouts.app')
>>>>>>> b1b9ddc6ed5bc1e1a465aa5643ae4d4a8f2d6400

@section('title', 'Kategori Buku')

@section('content')
<div class="card p-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="fw-bold mb-0">Daftar Kategori</h5>

        @if (auth()->user()->role === 'admin')
            <a href="{{ route('categories.create') }}" class="btn btn-primary">
                + Tambah Kategori
            </a>
        @endif
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle text-center">
            <thead class="table-light">
                <tr>
                    <th width="5%">No</th>
                    <th>Nama Kategori</th>
                    <th>Deskripsi</th>
                    <th width="15%">Jumlah Buku</th>

                    @if (auth()->user()->role === 'admin')
                        <th width="20%">Aksi</th>
                    @endif
                </tr>
            </thead>

            <tbody>
                @forelse ($categories as $category)
                    <tr>
                        <td>{{ $categories->firstItem() + $loop->index }}</td>

                        <td class="fw-semibold">
                            {{ $category->name }}
                        </td>

                        <td>
                            {{ $category->description ?? '-' }}
                        </td>

                        <td>
                            <span class="badge bg-info text-dark">
                                {{ $category->books_count }}
                            </span>
                        </td>

                        @if (auth()->user()->role === 'admin')
                            <td>
                                <div class="d-flex justify-content-center gap-1">
                                    <a href="{{ route('categories.edit', $category) }}"
                                       class="btn btn-sm btn-warning">
                                        Edit
                                    </a>

                                    <form method="POST"
                                          action="{{ route('categories.destroy', $category) }}"
                                          onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-sm btn-danger">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        @endif
                    </tr>
                @empty
                    <tr>
                        <td colspan="{{ auth()->user()->role === 'admin' ? 5 : 4 }}"
                            class="text-muted py-4">
                            Belum ada data kategori.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {{ $categories->links() }}
    </div>
</div>
@endsection
