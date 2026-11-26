@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Detail Anggota</h3>

    <table class="table table-bordered w-50">
        <tr><th width="200">Kode Anggota</th><td>{{ $member->member_code }}</td></tr>
        <tr><th>Nama</th><td>{{ $member->name }}</td></tr>
        <tr><th>Email</th><td>{{ $member->email }}</td></tr>
        <tr><th>Telepon</th><td>{{ $member->phone ?? '-' }}</td></tr>
        <tr><th>Alamat</th><td>{{ $member->address ?? '-' }}</td></tr>
        <tr><th>Tanggal Bergabung</th><td>{{ $member->joined_at->format('d M Y') }}</td></tr>
        <tr>
            <th>Status</th>
            <td>{{ $member->status === 'active' ? 'Aktif' : 'Nonaktif' }}</td>
        </tr>
    </table>

    <a href="{{ route('members.edit', $member) }}" class="btn btn-warning">Edit</a>
    <a href="{{ route('members.index') }}" class="btn btn-secondary">Kembali</a>
</div>
@endsection