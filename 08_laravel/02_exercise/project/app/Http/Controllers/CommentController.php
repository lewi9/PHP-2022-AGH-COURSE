<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        $comments = \App\Models\Comment::findOrFail(1);
        return view('index')->with('comments', $comments);
    }
}
