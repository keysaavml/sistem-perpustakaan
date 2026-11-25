@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<div class="mb-4">
    <h5 class="fw-bold">Selamat Datang di Sistem Informasi Perpustakaan</h5>
    <p class="text-muted">Berikut ringkasan data perpustakaan saat ini.</p>
</div>

<div class="row g-4">

    <!-- Total Judul Buku -->
    <div class="col-md-6 col-xl-3">
        <div class="card p-4 h-100">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-muted mb-2">Total Judul Buku</p>
                    <h2 class="fw-bold mb-0">{{ $totalBooks }}</h2>
                </div>
                <div class="fs-1">📚</div>
            </div>
        </div>
    </div>

    <!-- Total Stok Buku -->
    <div class="col-md-6 col-xl-3">
        <div class="card p-4 h-100">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-muted mb-2">Total Stok Buku</p>
                    <h2 class="fw-bold mb-0">{{ $totalStock }}</h2>
                </div>
                <div class="fs-1">📦</div>
            </div>
        </div>
    </div>

    <!-- Total Anggota -->
    <div class="col-md-6 col-xl-3">
        <div class="card p-4 h-100">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-muted mb-2">Jumlah Anggota</p>
                    <h2 class="fw-bold mb-0">{{ $totalMembers }}</h2>
                </div>
                <div class="fs-1">👥</div>
            </div>
        </div>
    </div>

    <!-- Peminjaman Aktif -->
    <div class="col-md-6 col-xl-3">
        <div class="card p-4 h-100">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-muted mb-2">Peminjaman Aktif</p>
                    <h2 class="fw-bold mb-0">{{ $activeBorrowings }}</h2>
                </div>
                <div class="fs-1">📖</div>
            </div>
        </div>
    </div>

</div>

@endsection
