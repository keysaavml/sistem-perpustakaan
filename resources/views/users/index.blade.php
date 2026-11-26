@extends('layouts.app')

@section('title', 'Manajemen User')

@section('content')

<div class="card p-4">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h5 class="fw-bold mb-1">Daftar User</h5>
            <p class="text-muted mb-0">Kelola akun Admin dan Petugas perpustakaan.</p>
        </div>

        <a href="{{ route('users.create') }}" class="btn btn-primary">
            + Tambah User
        </a>
    </div>

    <!-- Notifikasi berhasil -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Notifikasi error -->
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Tabel User -->
    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle text-center">

            <thead class="table-light">
                <tr>
                    <th width="7%">No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th width="15%">Role</th>
                    <th width="20%">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($users as $user)
                    <tr>
                        <td>{{ $users->firstItem() + $loop->index }}</td>

                        <td class="text-start fw-semibold">
                            {{ $user->name }}
                        </td>

                        <td>{{ $user->email }}</td>

                        <td>
                            @if ($user->role === 'admin')
                                <span class="badge bg-primary">Admin</span>
                            @else
                                <span class="badge bg-secondary">Petugas</span>
                            @endif
                        </td>

                        <td>
                            <div class="d-flex justify-content-center gap-2">

                                <a href="{{ route('users.edit', $user) }}"
                                   class="btn btn-sm btn-warning">
                                    Edit
                                </a>

                                <form method="POST"
                                      action="{{ route('users.destroy', $user) }}"
                                      onsubmit="return confirm('Yakin ingin menghapus user ini?')">

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
                        <td colspan="5" class="text-muted py-4">
                            Belum ada data user.
                        </td>
                    </tr>
                @endforelse
            </tbody>

        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-3">
        {{ $users->links() }}
    </div>

</div>

@endsection
