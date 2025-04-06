<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
    use HasFactory;
    protected $table = 'books';
    protected $fillable = ['title', 'author', 'category', 'quantity'];
    public function borrowReturns()
    {
        return $this->hasMany(BorrowReturn::class, 'book_id');
    }
}
