<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    // Many-to-many with Book
    public function books()
    {
        return $this->belongsToMany(Book::class, 'book_category');
    }
}