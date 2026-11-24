@csrf

<div>
    <label>Nama</label><br>
    <input type="text" name="name" value="{{ old('name', $user->name ?? '') }}">
    @error('name') <br><small style="color:red">{{ $message }}</small> @enderror
</div>

<div>
    <label>Email</label><br>
    <input type="email" name="email" value="{{ old('email', $user->email ?? '') }}">
    @error('email') <br><small style="color:red">{{ $message }}</small> @enderror
</div>

<div>
    <label>Role</label><br>
    <select name="role">
        @foreach (['admin' => 'Admin', 'petugas' => 'Petugas'] as $value => $label)
            <option value="{{ $value }}" @selected(old('role', $user->role ?? 'petugas') === $value)>
                {{ $label }}
            </option>
        @endforeach
    </select>
    @error('role') <br><small style="color:red">{{ $message }}</small> @enderror
</div>

<div>
    <label>Password {{ isset($user) ? '(kosongkan jika tidak diubah)' : '' }}</label><br>
    <input type="password" name="password">
    @error('password') <br><small style="color:red">{{ $message }}</small> @enderror
</div>

<div>
    <label>Konfirmasi Password</label><br>
    <input type="password" name="password_confirmation">
</div>

<button type="submit">Simpan</button>
<a href="{{ route('users.index') }}">Batal</a>