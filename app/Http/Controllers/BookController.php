<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::all();
        return response()->json($books);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'author' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'publish_date' => 'required|date',
            'isbn' => 'required|string|max:13|unique:books',
            'summary' => 'required|string',
            'price' => 'required|numeric',
            'on_store' => 'required|numeric',
        ]);

        $book = Book::create($validatedData);

        return response()->json($book, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        return response()->json($book);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        $validatedData = $request->validate([
            'author' => 'sometimes|string|max:255',
            'title' => 'sometimes|string|max:255',
            'publish_date' => 'sometimes|date',
            'isbn' => 'sometimes|string|max:13|unique:books,isbn,' . $book->id,
            'summary' => 'sometimes|string',
            'price' => 'sometimes|numeric',
            'on_store' => 'sometimes|numeric',
        ]);

        $book->update($validatedData);

        return response()->json($book);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        // Delete the book
        $book->delete();

        return response()->json(null, 204);
    }
}
