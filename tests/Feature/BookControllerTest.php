<?php

namespace Tests\Feature;

use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class BookControllerTest extends TestCase
{
    // use RefreshDatabase;

    /**
     * Test the index method.
     *
     * @return void
     */
    public function testIndex()
    {
        $books = Book::factory()->count(3)->create();

        $response = $this->getJson('/api/books');

        $response->assertStatus(Response::HTTP_OK)
                 ->assertJson($books->toArray());
    }

    /**
     * Test the store method with valid data.
     *
     * @return void
     */
    public function testStore()
    {
        $data = [
            'author' => 'John Doe',
            'title' => 'Sample Book',
            'publish_date' => '2024-09-12',
            'isbn' => '1234567890123',
            'summary' => 'This is a sample book.',
            'price' => 19.99,
            'on_store' => 1,
        ];

        $response = $this->postJson('/api/books', $data);

        $response->assertStatus(Response::HTTP_CREATED)
                 ->assertJson($data);
    }

    /**
     * Test the store method with duplicate ISBN.
     *
     * @return void
     */
    public function testStoreWithDuplicateIsbn()
    {
        Book::factory()->create(['isbn' => '1234567890123']);

        $data = [
            'author' => 'John Doe',
            'title' => 'Sample Book',
            'publish_date' => '2024-09-12',
            'isbn' => '1234567890123',
            'summary' => 'This is a sample book.',
            'price' => 19.99,
            'on_store' => 1,
        ];

        $response = $this->postJson('/api/books', $data);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * Test the show method with a valid book ID.
     *
     * @return void
     */
    public function testShow()
    {
        $book = Book::factory()->create();

        $response = $this->getJson('/api/books/' . $book->id);

        $response->assertStatus(Response::HTTP_OK)
                 ->assertJson($book->toArray());
    }

    /**
     * Test the show method with an invalid book ID.
     *
     * @return void
     */
    public function testShowNotFound()
    {
        $response = $this->getJson('/api/books/999');

        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }

    /**
     * Test the update method with valid data.
     *
     * @return void
     */
    public function testUpdate()
    {
        $book = Book::factory()->create();

        $data = [
            'author' => 'Jane Doe',
            'title' => 'Updated Book',
            'publish_date' => '2024-09-13',
            'isbn' => '1234567890124',
            'summary' => 'This is an updated book.',
            'price' => 29.99,
            'on_store' => 1,
        ];

        $response = $this->putJson('/api/books/' . $book->id, $data);

        $response->assertStatus(Response::HTTP_OK)
                 ->assertJson($data);
    }

    /**
     * Test the update method with a duplicate ISBN.
     *
     * @return void
     */
    public function testUpdateWithDuplicateIsbn()
    {
        $existingBook = Book::factory()->create(['isbn' => '1234567890124']);
        $bookToUpdate = Book::factory()->create(['isbn' => '1234567890123']);

        $data = [
            'isbn' => '1234567890124',
        ];

        $response = $this->putJson('/api/books/' . $bookToUpdate->id, $data);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * Test the destroy method with a valid book ID.
     *
     * @return void
     */
    public function testDestroy()
    {
        $book = Book::factory()->create();

        $response = $this->deleteJson('/api/books/' . $book->id);

        $response->assertStatus(Response::HTTP_NO_CONTENT);
        $this->assertDatabaseMissing('books', ['id' => $book->id]);
    }

    /**
     * Test the destroy method with an invalid book ID.
     *
     * @return void
     */
    public function testDestroyNotFound()
    {
        $response = $this->deleteJson('/api/books/999');

        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }
}
