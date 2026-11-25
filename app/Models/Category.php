<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $fillable = ['name', 'description'];

    public function books(): HasMany
    {
        return $this->hasMany(Book::class);
    }
    
    public function borrowingDetails(): HasMany
    {
        return $this->hasMany(BorrowingDetail::class);
    }

    public function borrowings(): BelongsToMany
    {
        return $this->belongsToMany(Borrowing::class, 'borrowing_details')
            ->withPivot('quantity')
            ->withTimestamps();
    }
}