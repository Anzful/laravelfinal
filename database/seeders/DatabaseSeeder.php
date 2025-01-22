<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Profile;
use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Models\Review;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Create some basic users with profiles
        User::factory()
            ->count(5)
            ->has(Profile::factory())
            ->create();

        // Create Authors with Books
        Author::factory()
            ->count(5)
            ->has(Book::factory()->count(3))
            ->create();

        // Create categories
        $categories = Category::factory()->count(5)->create();

        // Attach categories to books randomly
        $allBooks = Book::all();
        foreach ($allBooks as $book) {
            $randomCategories = $categories->random(rand(1, 3))->pluck('id');
            $book->categories()->attach($randomCategories);

            // Add reviews
            Review::factory()->count(2)->create([
                'reviewable_id' => $book->id,
                'reviewable_type' => Book::class,
            ]);
        }

        // Add some reviews to authors
        $allAuthors = Author::all();
        foreach ($allAuthors as $author) {
            Review::factory()->count(1)->create([
                'reviewable_id' => $author->id,
                'reviewable_type' => Author::class,
            ]);
        }
    }
}
