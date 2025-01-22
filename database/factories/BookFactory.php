<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\Author;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    protected $model = Book::class;

    public function definition()
    {
        return [
            'author_id' => Author::factory(),
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
        ];
    }
}
