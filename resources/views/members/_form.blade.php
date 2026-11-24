@php $isEdit = isset($member); @endphp

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

<div class="mb-3">
    <label class="form-label">Tanggal Bergabung</label>
    <input type="date" name="joined_at" class="form-control @error('joined_at') is-invalid @enderror"
           value="{{ old('joined_at', isset($member) ? $member->joined_at->format('Y-m-d') : date('Y-m-d')) }}">
    @error('joined_at') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label class="form-label">Status</label>
    <select name="status" class="form-select @error('status') is-invalid @enderror">
        <option value="active"   @selected(old('status', $member->status ?? 'active') === 'active')>Aktif</option>
        <option value="inactive" @selected(old('status', $member->status ?? '') === 'inactive')>Nonaktif</option>
    </select>
    @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<button type="submit" class="btn btn-primary">Simpan</button>
<a href="{{ route('members.index') }}" class="btn btn-secondary">Batal</a>