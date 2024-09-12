<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Exceptions\BookNotFoundException;
use App\Exceptions\DuplicateEntryException;

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

        try {
            $book = Book::create($validatedData);
            return response()->json($book, 201);
        } catch (QueryException $e) {
            if ($e->getCode() === '23505') {
                throw new DuplicateEntryException();
            }
            throw $e;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $book = Book::find($id);
        if (!$book) {
            throw new BookNotFoundException();
        }
        return response()->json($book);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'author' => 'sometimes|string|max:255',
            'title' => 'sometimes|string|max:255',
            'publish_date' => 'sometimes|date',
            'isbn' => 'sometimes|string|max:13|unique:books,isbn,' . $id,
            'summary' => 'sometimes|string',
            'price' => 'sometimes|numeric',
            'on_store' => 'sometimes|numeric',
        ]);

        $book = Book::find($id);
        if (!$book) {
            throw new BookNotFoundException();
        }

        try {
            $book->update($validatedData);
            return response()->json($book);
        } catch (QueryException $e) {
            if ($e->getCode() === '23505') {
                throw new DuplicateEntryException();
            }
            throw $e;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $book = Book::find($id);
        if (!$book) {
            throw new BookNotFoundException();
        }

        $book->delete();
        return response()->json(null, 204);
    }
}
