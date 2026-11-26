<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Borrowing extends Model
{
    protected $table = 'borrowings';

    protected $fillable = [
        'user_id',
        'member_id',
        'borrow_date',
        'due_date',
        'return_date',
        'status',
    ];

    protected $casts = [
        'borrow_date' => 'date',
        'due_date' => 'date',
        'return_date' => 'date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class);
    }

    public function details(): HasMany
    {
        return $this->hasMany(BorrowingDetail::class);
    }

    public function books(): BelongsToMany
    {
        return $this->belongsToMany(Book::class, 'borrowing_details')
            ->withPivot('quantity')
            ->withTimestamps();
    }

    // Terlambat = masih dipinjam dan jatuh tempo sudah lewat hari ini
    public function isOverdue(): bool
    {
        return $this->status === 'borrowed' && $this->due_date->lt(today());
    }
}