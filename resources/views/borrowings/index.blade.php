@extends('layouts.app')

@section('title', 'Peminjaman Buku')

@section('content')
<div class="card p-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="fw-bold mb-0">Daftar Peminjaman</h5>
        <a href="{{ route('borrowings.create') }}" class="btn btn-primary">+ Peminjaman Baru</a>
    </div>

    @if (session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
    @if (session('error'))   <div class="alert alert-danger">{{ session('error') }}</div>   @endif

    <form method="GET" action="{{ route('borrowings.index') }}" class="mb-3 w-25">
        <select name="status" class="form-select" onchange="this.form.submit()">
            <option value="">Semua status</option>
            <option value="borrowed" @selected(request('status') === 'borrowed')>Dipinjam</option>
            <option value="returned" @selected(request('status') === 'returned')>Dikembalikan</option>
        </select>
    </form>

    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Anggota</th>
                    <th>Petugas</th>
                    <th>Tgl Pinjam</th>
                    <th>Jatuh Tempo</th>
                    <th>Total Buku</th>
                    <th>Status</th>
                    <th width="190">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($borrowings as $b)
                    <tr>
                        <td>{{ $borrowings->firstItem() + $loop->index }}</td>
                        <td>{{ $b->member->name }}</td>
                        <td>{{ $b->user->name }}</td>
                        <td>{{ $b->borrow_date->format('d M Y') }}</td>
                        <td>{{ $b->due_date->format('d M Y') }}</td>
                        <td>{{ $b->total_books }}</td>
                        <td>
                            @if ($b->status === 'returned')
                                <span class="badge bg-success">Dikembalikan</span>
                            @elseif ($b->isOverdue())
                                <span class="badge bg-danger">Terlambat</span>
                            @else
                                <span class="badge bg-warning text-dark">Dipinjam</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('borrowings.show', $b) }}" class="btn btn-sm btn-info text-white">Detail</a>
                            @if ($b->status === 'borrowed')
                                <form action="{{ route('borrowings.return', $b) }}" method="POST" class="d-inline"
                                      onsubmit="return confirm('Tandai peminjaman ini sudah dikembalikan?')">
                                    @csrf
                                    @method('PATCH')
                                    <button class="btn btn-sm btn-success">Kembalikan</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="8" class="text-center text-muted py-4">Belum ada data peminjaman.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $borrowings->links() }}
</div>
@endsection