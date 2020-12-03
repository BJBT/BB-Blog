@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1>Community Posts</h1>
                @foreach ($posts as $post)
                        <div class="card">
                            <div class="card-body">
                                <h6>{{ $post->owner->name }} posted: </h6>
                                <h4>{{ $post->title }}</h4>
                                <a href="{{ $post->path() }}">
                                    <strong>{{ $post->comments_count }} comments</strong>
                                </a>
                                @if (auth()->check())
                                    <div class="row justify-content-center mb-6">
                                        <div class="col-md-6">
                                            <form method="POST" action="/posts/{{ $post->id }}/like">
                                                @csrf
                                                <button type="submit" class="btn btn-outline-success btn-block">{{ $post->likes ?: 0 }} Likes</button>
                                            </form>
                                        </div>
                                        <div class="col-md-6">
                                            <form method="POST" action="/posts/{{ $post->id }}/like">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger btn-block">{{ $post->dislikes ?: 0 }} Dislikes</button>
                                            </form>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    <br>
                @endforeach
            </div>
        </div>
    </div>
@endsection
