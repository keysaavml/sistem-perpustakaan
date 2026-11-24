<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class MemberController extends Controller
{
    // LIST anggota (dengan pencarian + pagination)
    public function index(Request $request): View
    {
        $members = Member::query()
            ->when($request->search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('member_code', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->orderBy('name')
            ->paginate(10)
            ->withQueryString();

        return view('members.index', compact('members'));
    }

    // FORM tambah anggota
    public function create(): View
    {
        return view('members.create');
    }

    // SIMPAN anggota baru
    public function store(Request $request): RedirectResponse
    {
        Member::create($request->validate($this->rules()));

        return redirect()->route('members.index')
            ->with('success', 'Anggota berhasil ditambahkan.');
    }

    // DETAIL anggota
    public function show(Member $member): View
    {
        return view('members.show', compact('member'));
    }

    // FORM edit anggota
    public function edit(Member $member): View
    {
        return view('members.edit', compact('member'));
    }

    // SIMPAN perubahan anggota
    public function update(Request $request, Member $member): RedirectResponse
    {
        $member->update($request->validate($this->rules($member)));

        return redirect()->route('members.index')
            ->with('success', 'Anggota berhasil diperbarui.');
    }

    // HAPUS anggota
    public function destroy(Member $member): RedirectResponse
    {
        // Aktifkan jika sudah ada relasi loans:
        // if ($member->loans()->exists()) {
        //     return back()->with('error', 'Anggota masih punya riwayat peminjaman, tidak bisa dihapus.');
        // }

        $member->delete();

        return redirect()->route('members.index')
            ->with('success', 'Anggota berhasil dihapus.');
    }

    // Aturan validasi dipakai bersama oleh store & update
    private function rules(?Member $member = null): array
    {
        return [
            'name'      => ['required', 'string', 'max:255'],
            'email'     => ['required', 'email', 'max:255',
                            Rule::unique('members', 'email')->ignore($member?->id)],
            'phone'     => ['nullable', 'string', 'max:20'],
            'address'   => ['nullable', 'string'],
            'joined_at' => ['required', 'date'],
            'status'    => ['required', Rule::in(['active', 'inactive'])],
        ];
    }
}