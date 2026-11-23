<h1>Tambah Kategori</h1>

<form method="POST" action="{{ route('categories.store') }}">
    @include('categories._form')
</form>