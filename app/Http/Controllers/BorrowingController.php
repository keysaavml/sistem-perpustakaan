<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrowing;
use App\Models\Member;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use RuntimeException;

class BorrowingController extends Controller
{
    // LIST peminjaman (filter status + pagination)
    public function index(Request $request): View
    {
        $borrowings = Borrowing::with(['member', 'user'])
            ->withSum('details as total_books', 'quantity')
            ->when($request->status, fn ($q, $status) => $q->where('status', $status))
            ->latest('borrow_date')
            ->latest('id')
            ->paginate(10)
            ->withQueryString();

        return view('borrowings.index', compact('borrowings'));
    }

    // FORM peminjaman baru
    public function create(): View
    {
        $members = Member::orderBy('name')->get();
        $books   = Book::where('stock', '>', 0)->orderBy('title')->get();

        return view('borrowings.create', compact('members', 'books'));
    }

    // SIMPAN peminjaman: header + detail + kurangi stok (satu transaksi)
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'member_id'         => ['required', 'exists:members,id'],
            'borrow_date'       => ['required', 'date'],
            'books'             => ['required', 'array', 'min:1'],
            'books.*.book_id'   => ['required', 'distinct', 'exists:books,id'],
            'books.*.quantity'  => ['required', 'integer', 'min:1'],
        ], [
            'books.*.book_id.required' => 'Pilih buku pada setiap baris.',
            'books.*.book_id.distinct' => 'Buku yang sama tidak boleh dipilih dua kali.',
            'books.*.quantity.min'     => 'Jumlah minimal 1.',
        ]);

        try {
            DB::transaction(function () use ($validated) {
                $borrowing = Borrowing::create([
                    'user_id'     => Auth::id(),   // petugas yang sedang login
                    'member_id'   => $validated['member_id'],
                    'borrow_date' => $validated['borrow_date'],
                    // due date otomatis 1 minggu setelah tanggal pinjam
                    'due_date'    => Carbon::parse($validated['borrow_date'])->addWeek()->toDateString(),
                    'status'      => 'borrowed',
                ]);

                foreach ($validated['books'] as $item) {
                    // lockForUpdate: cegah stok dipakai dua transaksi sekaligus
                    $book = Book::lockForUpdate()->findOrFail($item['book_id']);

                    if ($book->stock < $item['quantity']) {
                        throw new RuntimeException(
                            "Stok buku \"{$book->title}\" tidak cukup (tersisa {$book->stock})."
                        );
                    }

                    $borrowing->details()->create([
                        'book_id'  => $book->id,
                        'quantity' => $item['quantity'],
                    ]);

                    $book->decrement('stock', $item['quantity']);
                }
            });
        } catch (RuntimeException $e) {
            // transaksi otomatis di-rollback
            return back()->withInput()->with('error', $e->getMessage());
        }

        return redirect()->route('borrowings.index')
            ->with('success', 'Peminjaman berhasil dicatat.');
    }

    // DETAIL peminjaman
    public function show(Borrowing $borrowing): View
    {
        $borrowing->load(['member', 'user', 'details.book']);

        return view('borrowings.show', compact('borrowing'));
    }

    // PENGEMBALIAN: status jadi returned + stok dikembalikan
    public function returnBook(Borrowing $borrowing): RedirectResponse
    {
        if ($borrowing->status === 'returned') {
            return back()->with('error', 'Peminjaman ini sudah dikembalikan.');
        }

        DB::transaction(function () use ($borrowing) {
            foreach ($borrowing->details as $detail) {
                Book::whereKey($detail->book_id)->increment('stock', $detail->quantity);
            }

            $borrowing->update([
                'status'      => 'returned',
                'return_date' => today(),
            ]);
        });

        return redirect()->route('borrowings.show', $borrowing)
            ->with('success', 'Buku berhasil dikembalikan, stok sudah diperbarui.');
    }
}