<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Informasi Perpustakaan</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f4f6f9;
        }

        .sidebar {
            min-height: 100vh;
            background-color: #212529;
            color: #fff;
            display: flex;
            flex-direction: column;
        }

        .sidebar a {
            color: #adb5bd;
            text-decoration: none;
            padding: 12px 20px;
            display: block;
            border-radius: 6px;
            margin-bottom: 4px;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background-color: #0d6efd;
            color: #fff;
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.06);
        }

        .logout-section {
            margin-top: auto;
            padding-top: 20px;
        }
    </style>
</head>

<body>
<div class="container-fluid">
    <div class="row">

        <nav class="col-md-2 d-none d-md-flex sidebar p-3">

            <div>
                <h5 class="text-white fw-bold mb-4 px-2">
                    📚 Perpustakaan
                </h5>

                <a href="{{ url('/') }}"
                   class="{{ request()->is('/') ? 'active' : '' }}">
                    Dashboard
                </a>

                @if (auth()->user()->role === 'admin')
                    <a href="{{ route('users.index') }}"
                       class="{{ request()->is('users*') ? 'active' : '' }}">
                        Manajemen User
                    </a>
                @endif

                <a href="{{ route('categories.index') }}"
                   class="{{ request()->is('categories*') ? 'active' : '' }}">
                    Kategori Buku
                </a>

                <a href="{{ route('books.index') }}"
                   class="{{ request()->is('books*') ? 'active' : '' }}">
                    Manajemen Buku
                </a>

                <a href="{{ route('members.index') }}"
                   class="{{ request()->is('members*') ? 'active' : '' }}">
                    Data Anggota
                </a>

                <a href="{{ route('borrowings.index') }}"
                   class="{{ request()->is('borrowings*') ? 'active' : '' }}">
                    Peminjaman
                </a>
            </div>

            <div class="logout-section">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf

                    <button type="submit" class="btn btn-danger w-100">
                        ↪ Logout
                    </button>
                </form>
            </div>

        </nav>

        <main class="col-md-10 ms-sm-auto px-md-4 py-4">

            <div class="d-flex justify-content-between align-items-center pb-3 mb-4 border-bottom">
                <h4 class="fw-bold mb-0">
                    @yield('title', 'Sistem Informasi Perpustakaan')
                </h4>

                <span class="badge bg-secondary">
                    {{ ucfirst(auth()->user()->role) }}
                </span>
            </div>

            @yield('content')

        </main>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
