
<h1>Daftar Kategori</h1>

@if (session('success')) <div style="color:green">{{ session('success') }}</div> @endif
@if (session('error'))   <div style="color:red">{{ session('error') }}</div> @endif

<p><a href="{{ route('categories.create') }}">+ Tambah Kategori</a></p>

<table border="1" cellpadding="6" cellspacing="0">
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Deskripsi</th>
        <th>Jumlah Buku</th>
        <th>Aksi</th>
    </tr>
    @forelse ($categories as $category)
        <tr>
            <td>{{ $categories->firstItem() + $loop->index }}</td>
            <td>{{ $category->name }}</td>
            <td>{{ $category->description ?? '-' }}</td>
            <td>{{ $category->books_count }}</td>
            <td>
                <a href="{{ route('categories.edit', $category) }}">Edit</a>
                <form method="POST" action="{{ route('categories.destroy', $category) }}" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Hapus kategori ini?')">Hapus</button>
                </form>
            </td>
        </tr>
    @empty
        <tr><td colspan="5">Belum ada kategori.</td></tr>
    @endforelse
</table>

{{ $categories->links() }}