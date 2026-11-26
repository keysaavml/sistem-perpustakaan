<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Book extends Model
{
    protected $table = 'books';

    protected $fillable = [
        'category_id',
        'title',
        'author',
        'year',
        'stock',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Cari buku berdasarkan judul, penulis, tahun terbit, atau nama kategori.
     */
    public function scopeSearch(Builder $query, ?string $term): Builder
    {
        $term = trim((string) $term);

        if ($term === '') {
            return $query;
        }

        $like = "%{$term}%";

        return $query->where(function (Builder $q) use ($like) {
            $q->where('title', 'like', $like)
              ->orWhere('author', 'like', $like)
              ->orWhere('year', 'like', $like)
              ->orWhereHas('category', function (Builder $c) use ($like) {
                  $c->where('name', 'like', $like);
              });
        });
    }

    /**
     * Filter berdasarkan kategori (diabaikan jika kosong).
     */
    public function scopeInCategory(Builder $query, ?int $categoryId): Builder
    {
        return $query->when($categoryId, function (Builder $q, int $id) {
            $q->where('category_id', $id);
        });
    }

    /**
     * Filter stok: 'available' (stok > 0) atau 'empty' (stok = 0).
     */
    public function scopeStockStatus(Builder $query, ?string $status): Builder
    {
        return match ($status) {
            'available' => $query->where('stock', '>', 0),
            'empty'     => $query->where('stock', 0),
            default     => $query,
        };
    }
}