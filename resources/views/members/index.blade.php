@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Daftar Anggota</h3>
        <a href="{{ route('members.create') }}" class="btn btn-primary">+ Tambah Anggota</a>
    </div>

    @if (session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
    @if (session('error'))   <div class="alert alert-danger">{{ session('error') }}</div>   @endif

    <form method="GET" action="{{ route('members.index') }}" class="mb-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control"
                   placeholder="Cari nama, email, atau telepon..." value="{{ request('search') }}">
            <button class="btn btn-outline-secondary">Cari</button>
        </div>
    </form>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Telepon</th>
                <th width="200">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($members as $member)
                <tr>
                    <td>{{ $members->firstItem() + $loop->index }}</td>
                    <td>{{ $member->name }}</td>
                    <td>{{ $member->email ?? '-' }}</td>
                    <td>{{ $member->phone ?? '-' }}</td>
                    <td>
                        <a href="{{ route('members.show', $member) }}" class="btn btn-sm btn-info">Detail</a>
                        <a href="{{ route('members.edit', $member) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('members.destroy', $member) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Yakin hapus anggota ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="text-center">Belum ada data anggota.</td></tr>
            @endforelse
        </tbody>
    </table>

    {{ $members->links() }}
</div>
@endsection