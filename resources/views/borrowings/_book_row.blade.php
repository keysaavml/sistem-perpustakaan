<div class="row g-2 mb-2 book-row">
    <div class="col-md-8">
        <select name="books[{{ $i }}][book_id]" class="form-select">
            <option value="">-- Pilih Buku --</option>
            @foreach ($books as $book)
                <option value="{{ $book->id }}" @selected($row['book_id'] == $book->id)>
                    {{ $book->title }} (stok: {{ $book->stock }})
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-md-2">
        <input type="number" name="books[{{ $i }}][quantity]" min="1"
               value="{{ $row['quantity'] }}" class="form-control" placeholder="Jumlah">
    </div>
    <div class="col-md-2">
        <button type="button" class="btn btn-outline-danger w-100 remove-row">Hapus</button>
    </div>
</div>