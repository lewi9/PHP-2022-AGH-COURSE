<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BookController extends Controller
{
    public function index(): View
    {
        return view('books.index')->with('books', Book::all());
    }

    public function create(): View
    {
        return view('books.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'isbn' => ['required', 'string', 'digits:13', 'unique:' . Book::class],
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
        ]);

        $book = Book::create([
            'isbn' => $request->isbn,
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return redirect("books/".strval($book->id));
    }

    public function show(int $id): View
    {
        return view('books.show')->with('book', Book::where('id', $id)->get()[0]);
    }
}
