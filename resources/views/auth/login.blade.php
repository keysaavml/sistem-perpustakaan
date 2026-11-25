<h1>Login</h1>

<form method="POST" action="{{ route('login') }}">
    @csrf

    <div>
        <label>Email</label><br>
        <input type="email" name="email" value="{{ old('email') }}">
        @error('email') <br><small style="color:red">{{ $message }}</small> @enderror
    </div>

    <div>
        <label>Password</label><br>
        <input type="password" name="password">
    </div>

    <div>
        <label><input type="checkbox" name="remember"> Ingat saya</label>
    </div>

    <button type="submit">Masuk</button>
</form>