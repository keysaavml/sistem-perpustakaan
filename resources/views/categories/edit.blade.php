<h1>Edit Kategori</h1>

<form method="POST" action="{{ route('categories.update', $category) }}">
    @method('PUT')
    @include('categories._form')
</form>