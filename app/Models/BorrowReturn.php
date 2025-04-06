<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BorrowReturn extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'book_id', 'borrow_date', 'return_date', 'returned_at', 'status', 'fine'
    ];
    
    protected $dates = ['borrow_date', 'return_date'];

    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id');
    }

    public static function getBorrowStats() {
        return User::withCount([
            'borrowReturns as borrowed_books' => function ($query) {
                $query->where('status', 'borrowed');
            },
            'borrowReturns as returned_books' => function ($query) {
                $query->where('status', 'returned');
            },
            'borrowReturns as late_returns' => function ($query) {
                $query->where('status', 'late');
            },
            'borrowReturns as lost_books' => function ($query) {
                $query->where('status', 'lost');
            }
        ])->get();
    }
}
