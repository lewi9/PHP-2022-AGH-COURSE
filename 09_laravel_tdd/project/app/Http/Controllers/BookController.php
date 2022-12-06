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
            'isbn' => ['required', 'string', 'min:13', 'max:13', 'unique:' . Book::class],
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
        ]);
        Book::create([
            'isbn' => $request->isbn,
            'title' => $request->title,
            'description' => $request->description
        ]);

        return redirect("books.show.$request->id");
    }
}
