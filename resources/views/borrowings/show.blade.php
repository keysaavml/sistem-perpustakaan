@extends('layouts.app')

@section('title', 'Detail Peminjaman')

@section('content')
<div class="card p-4">
    @if (session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
    @if (session('error'))   <div class="alert alert-danger">{{ session('error') }}</div>   @endif

    <table class="table table-borderless">
        <tr><th width="20%">Anggota</th><td>: {{ $borrowing->member->name }}</td></tr>
        <tr><th>Petugas</th><td>: {{ $borrowing->user->name }}</td></tr>
        <tr><th>Tanggal Pinjam</th><td>: {{ $borrowing->borrow_date->format('d M Y') }}</td></tr>
        <tr><th>Jatuh Tempo</th><td>: {{ $borrowing->due_date->format('d M Y') }}</td></tr>
        <tr><th>Tanggal Kembali</th><td>: {{ $borrowing->return_date?->format('d M Y') ?? '-' }}</td></tr>
        <tr>
            <th>Status</th>
            <td>:
                @if ($borrowing->status === 'returned')
                    <span class="badge bg-success">Dikembalikan</span>
                @elseif ($borrowing->isOverdue())
                    <span class="badge bg-danger">Terlambat</span>
                @else
                    <span class="badge bg-warning text-dark">Dipinjam</span>
                @endif
            </td>
        </tr>
    </table>

    <h6 class="fw-bold">Buku yang Dipinjam</h6>
    <table class="table table-bordered">
        <thead class="table-light">
            <tr><th>Judul</th><th>Penulis</th><th width="100">Jumlah</th></tr>
        </thead>
        <tbody>
            @foreach ($borrowing->details as $detail)
                <tr>
                    <td>{{ $detail->book->title }}</td>
                    <td>{{ $detail->book->author }}</td>
                    <td>{{ $detail->quantity }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-3">
        <a href="{{ route('borrowings.index') }}" class="btn btn-secondary">← Kembali</a>
        @if ($borrowing->status === 'borrowed')
            <form action="{{ route('borrowings.return', $borrowing) }}" method="POST" class="d-inline"
                  onsubmit="return confirm('Tandai peminjaman ini sudah dikembalikan?')">
                @csrf
                @method('PATCH')
                <button class="btn btn-success">Kembalikan Buku</button>
            </form>
        @endif
    </div>
</div>
@endsection