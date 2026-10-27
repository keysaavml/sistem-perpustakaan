<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BorrowingDetail extends Model
{
    protected $table = 'borrowing_details';

    protected $fillable = [
        'borrowing_id',
        'book_id',
        'quantity',
    ];
}
