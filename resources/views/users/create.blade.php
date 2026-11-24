<h1>Tambah User</h1>

<form method="POST" action="{{ route('users.store') }}">
    @include('users._form')
</form>