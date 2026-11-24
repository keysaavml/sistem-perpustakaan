<h1>Edit User</h1>

<form method="POST" action="{{ route('users.update', $user) }}">
    @method('PUT')
    @include('users._form')
</form>