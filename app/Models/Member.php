<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable = [
        'member_code',
        'name',
        'email',
        'phone',
        'address',
        'joined_at',
        'status',
    ];

    protected $casts = [
        'joined_at' => 'date',
    ];

    // Kode anggota dibuat otomatis saat anggota baru disimpan
    protected static function booted(): void
    {
        static::creating(function (Member $member) {
            if (empty($member->member_code)) {
                $next = (static::max('id') ?? 0) + 1;
                $member->member_code = 'AGT' . str_pad($next, 4, '0', STR_PAD_LEFT);
            }
        });
    }

    // Aktifkan jika sudah ada model Loan (peminjaman):
    // public function loans()
    // {
    //     return $this->hasMany(Loan::class);
    // }
}