<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Book;
use App\Models\Author;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookApiTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_list_books()
    {
        $this->withoutExceptionHandling();
        $book = Book::factory()->create();

        $response = $this->getJson('/api/v1/books');
        
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data' => [
                         '*' => ['id', 'title', 'author', 'categories']
                     ]
                 ]);
    }

    /** @test */
    public function it_can_create_a_book()
    {
        $author = Author::factory()->create();
        $categories = Category::factory()->count(2)->create();

        $data = [
            'author_id' => $author->id,
            'title' => 'Test Book',
            'description' => 'Test Description',
            'categories' => $categories->pluck('id')->toArray(),
        ];

        $response = $this->postJson('/api/v1/books', $data);

        $response->assertStatus(201)
                 ->assertJsonPath('data.title', 'Test Book');
    }
}
