<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class BookController extends Controller
{
    public function index():
    {
        return view('books.index')->with('books')
    }
}
