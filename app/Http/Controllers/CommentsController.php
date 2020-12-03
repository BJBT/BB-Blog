<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request, Post $post)
    {
        $this->validate($request, [
            'body' => 'required'
        ]);

        $post->newComment([
            'user_id' => auth()->id(),
            'body' => request('body')
        ]);

        return redirect($post->path());
    }
}
