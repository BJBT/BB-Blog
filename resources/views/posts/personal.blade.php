@extends('layouts.app')

@section('content')
<div class="container">
    @if (auth()->check())
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>Create A New Post</h1>
                <form method="POST" action="/posts">
                    @csrf
                    <div class="form-group">
                        <label for="title"></label>
                        <textarea name="title" id="title" cols="0" rows="0" class="form-control" placeholder="Title"></textarea>
                        <label for="body"></label>
                        <textarea name="body" id="body" cols="20" rows="5" class="form-control" placeholder="Body"></textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-info"> Publish </button>
                    </div>
                </form>
            </div>
        </div>
        <hr>
        <div class="row justify-content-center">
            <div class="col-md-8">
            <h1>My Posts</h1>
            @foreach ($user->posts as $post)
                <div class="card">
                    <div class="card-body">
                        <h6>{{ $post->owner->name }} posted: </h6>
                        <h4>{{ $post->title }}</h4>
                        <a href="{{ $post->path() }}">
                            <strong>{{ $post->comments_count }} comments</strong>
                        </a>
                    </div>
                </div>
                <br>
            @endforeach
        </div>
    </div>
    @else
        <p class="text-center">Please <a href="{{ route('login') }}">sign in</a> to view your posts!</p>
    @endif
</div>
@endsection
