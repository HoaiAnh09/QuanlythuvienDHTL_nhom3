<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BookRequest extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'author', 'category', 'quantity', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
