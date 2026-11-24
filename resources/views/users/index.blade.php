<h1>Daftar User</h1>

@if (session('success')) <div style="color:green">{{ session('success') }}</div> @endif
@if (session('error'))   <div style="color:red">{{ session('error') }}</div> @endif

<p><a href="{{ route('users.create') }}">+ Tambah User</a></p>

<table border="1" cellpadding="6" cellspacing="0">
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Email</th>
        <th>Role</th>
        <th>Aksi</th>
    </tr>
    @foreach ($users as $user)
        <tr>
            <td>{{ $users->firstItem() + $loop->index }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ ucfirst($user->role) }}</td>
            <td>
                <a href="{{ route('users.edit', $user) }}">Edit</a>
                <form method="POST" action="{{ route('users.destroy', $user) }}" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Hapus user ini?')">Hapus</button>
                </form>
            </td>
        </tr>
    @endforeach
</table>

{{ $users->links() }}