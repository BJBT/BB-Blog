<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use Illuminate\Support\Facades\Auth;

class PostLikesController extends Controller
{
    public function store(Post $post)
    {
        $user = Auth::user();

        $post->like($user);

        return back();
    }

    public function destroy(Post $post)
    {
        $user = Auth::user();

        $post->dislike($user);

        return back();
    }
}
