@csrf

<div>
    <label>Nama Kategori</label><br>
    <input type="text" name="name" value="{{ old('name', $category->name ?? '') }}">
    @error('name') <br><small style="color:red">{{ $message }}</small> @enderror
</div>

<div>
    <label>Deskripsi</label><br>
    <textarea name="description" rows="3">{{ old('description', $category->description ?? '') }}</textarea>
    @error('description') <br><small style="color:red">{{ $message }}</small> @enderror
</div>

<button type="submit">Simpan</button>
<a href="{{ route('categories.index') }}">Batal</a>