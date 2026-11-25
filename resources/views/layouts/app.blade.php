<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Informasi Perpustakaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f4f6f9; }
        .sidebar { min-height: 100vh; background-color: #212529; color: #fff; }
        .sidebar a { color: #adb5bd; text-decoration: none; padding: 12px 20px; display: block; border-radius: 6px; margin-bottom: 4px; }
        .sidebar a:hover, .sidebar a.active { background-color: #0d6efd; color: #fff; }
        .card { border: none; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.06); }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <nav class="col-md-2 d-none d-md-flex flex-column sidebar p-3">
            <h5 class="text-white fw-bold mb-4 px-2">📚 Perpustakaan</h5>
            <a href="{{ url('/') }}" class="{{ request()->is('/') ? 'active' : '' }}">Dashboard</a>
            <a href="{{ route('categories.index') }}" class="{{ request()->is('categories*') ? 'active' : '' }}">Kategori Buku</a>
            <a href="{{ route('books.index') }}" class="{{ request()->is('books*') ? 'active' : '' }}">Manajemen Buku</a>
            <a href="#">Data Anggota</a>
            <a href="#">Peminjaman</a>

            <!-- Tombol Logout di bagian bawah sidebar -->
            <div class="mt-auto pt-3 border-top border-secondary">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" 
                            onclick="return confirm('Yakin ingin keluar dari sistem?')"
                            class="btn btn-outline-danger w-100 text-start px-3 py-2">
                        🚪 Logout
                    </button>
                </form>
            </div>
        </nav>

        <main class="col-md-10 ms-sm-auto px-md-4 py-4">
            <div class="d-flex justify-content-between align-items-center pb-3 mb-4 border-bottom">
                <h4 class="fw-bold mb-0">@yield('title', 'Sistem Informasi Perpustakaan')</h4>
                <span class="badge bg-secondary">Admin / Petugas</span>
            </div>

            @yield('content')
        </main>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>