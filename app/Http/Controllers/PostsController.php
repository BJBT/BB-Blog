<?php

namespace App\Http\Controllers;

use App\User;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    public function index()
    {
        $posts = Post::select("*")
            ->latest()
            ->withLikes()
            ->get();

        return view('posts.index', compact('posts'));
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
           'body' => 'required',
            'title' => 'required'
        ]);

        $post = Post::create([
            'user_id' => auth()->id(),
            'body' => request('body'),
            'title' => request('title')
        ]);

        return back();
    }

    public function personal()
    {
        $user = Auth::user();

        return view('posts.personal', compact('user'));
    }
}
