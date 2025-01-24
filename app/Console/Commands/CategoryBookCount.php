<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Category;

class CategoryBookCount extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'category:book-count';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Displays all categories along with the number of books in each category';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Fetch all categories with the count of related books
        $categories = Category::withCount('books')->get();

        if ($categories->isEmpty()) {
            $this->info('No categories found.');
            return 0;
        }

        // Define table headers
        $headers = ['Category ID', 'Category Name', 'Number of Books'];

        // Prepare data for the table
        $data = $categories->map(function ($category) {
            return [
                'id' => $category->id,
                'name' => $category->name,
                'books_count' => $category->books_count,
            ];
        })->toArray();

        // Display the table
        $this->table($headers, $data);

        return 0;
    }
}
