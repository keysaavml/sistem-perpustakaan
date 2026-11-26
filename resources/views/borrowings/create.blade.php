@extends('layouts.app')

@section('title', 'Form Peminjaman')

@section('content')
<div class="card p-4">
    @if (session('error')) <div class="alert alert-danger">{{ session('error') }}</div> @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('borrowings.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Anggota</label>
            <select name="member_id" class="form-select @error('member_id') is-invalid @enderror">
                <option value="">-- Pilih Anggota --</option>
                @foreach ($members as $member)
                    <option value="{{ $member->id }}" @selected(old('member_id') == $member->id)>
                        {{ $member->name }}
                    </option>
                @endforeach
            </select>
            @error('member_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Tanggal Pinjam</label>
                <input type="date" name="borrow_date" class="form-control @error('borrow_date') is-invalid @enderror"
                       value="{{ old('borrow_date', date('Y-m-d')) }}">
                @error('borrow_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Jatuh Tempo</label>
                <input type="date" name="due_date" class="form-control @error('due_date') is-invalid @enderror"
                       value="{{ old('due_date', date('Y-m-d', strtotime('+7 days'))) }}">
                @error('due_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        </div>

        <h6 class="fw-bold mt-2">Daftar Buku</h6>
        <div id="book-rows">
            @foreach (old('books', [['book_id' => '', 'quantity' => 1]]) as $i => $row)
                @include('borrowings._book_row', ['i' => $i, 'row' => $row, 'books' => $books])
            @endforeach
        </div>

        <button type="button" id="add-row" class="btn btn-outline-primary btn-sm mb-4">+ Tambah Buku</button>

        <div>
            <button type="submit" class="btn btn-primary">Simpan Peminjaman</button>
            <a href="{{ route('borrowings.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>

{{-- Template baris baru untuk JavaScript --}}
<template id="row-template">
    @include('borrowings._book_row', [
        'i' => '__INDEX__',
        'row' => ['book_id' => '', 'quantity' => 1],
        'books' => $books,
    ])
</template>

<script>
    let rowIndex = 1000; // indeks unik untuk baris baru
    const rowsBox = document.getElementById('book-rows');
    const template = document.getElementById('row-template');

    document.getElementById('add-row').addEventListener('click', () => {
        rowsBox.insertAdjacentHTML('beforeend', template.innerHTML.replaceAll('__INDEX__', rowIndex++));
    });

    rowsBox.addEventListener('click', (e) => {
        if (!e.target.classList.contains('remove-row')) return;
        // sisakan minimal satu baris
        if (rowsBox.querySelectorAll('.book-row').length > 1) {
            e.target.closest('.book-row').remove();
        }
    });
</script>
@endsection