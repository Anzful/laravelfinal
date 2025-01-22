<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = ['author_id', 'title', 'description'];

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    // Many-to-many with Category
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'book_category');
    }

    // Polymorphic relationship with reviews
    public function reviews()
    {
        return $this->morphMany(Review::class, 'reviewable');
    }
    /**
     * Get the table name.
     *
     * @return string
     */
    public function getTableName()
    {
        return $this->getTable();
    }
}
