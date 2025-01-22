<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'bio'];

    // One Author has many Books
    public function books()
    {
        return $this->hasMany(Book::class);
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
