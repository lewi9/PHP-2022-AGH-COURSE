<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Contracts\View\View;

class CommentController extends Controller
{
    public function index(): View
    {
        $comments = Comment::all();
        return view('index')->with('comments', $comments);
    }

    public function comment(int $id): View
    {
        $comment = Comment::where('id', $id)->get();
        return view('index')->with('comment', $comment);
    }
}
