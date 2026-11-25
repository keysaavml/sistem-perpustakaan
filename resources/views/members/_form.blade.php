<div class="mb-3">
    <label class="form-label">Nama</label>
    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
           value="{{ old('name', $member->name ?? '') }}">
    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label class="form-label">Email</label>
    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
           value="{{ old('email', $member->email ?? '') }}">
    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label class="form-label">No. Telepon</label>
    <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror"
           value="{{ old('phone', $member->phone ?? '') }}">
    @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label class="form-label">Alamat</label>
    <textarea name="address" rows="3"
              class="form-control @error('address') is-invalid @enderror">{{ old('address', $member->address ?? '') }}</textarea>
    @error('address') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<button type="submit" class="btn btn-primary">Simpan</button>
<a href="{{ route('members.index') }}" class="btn btn-secondary">Batal</a>