@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="body">
                            <h6>{{ $post->owner->name }} posted: </h6>
                            <h5>{{ $post->title }}</h5>
                            <p>{{ $post->body }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>

        {{--If a User is signed in they can comment, if not then show option to redirect to login--}}
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="row justify-content-center mt-10">
                    <h2>Comment:</h2>
                </div>
                @if (auth()->check())
                    <form method="POST" action="{{ $post->path() }}">
                        @csrf
                        <div class="form-group">
                            <textarea name="body" id="body" cols="20" rows="5" class="form-control"></textarea>
                            <button type="submit" class="btn btn-info"> Post </button>
                        </div>
                    </form>
                @else
                    <p class="text-center">Please <a href="{{ route('login') }}">sign in</a> to comment in this post!</p>
                @endif
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-8">
                @foreach ($post->comments as $comment)
                <div class="card">
                    <div class="card-body">
                        <h6>{{ $comment->owner->name }} commented: </h6>
                        <p>{{ $comment->body }}</p>
                    </div>
                </div>
                <br>
                @endforeach
            </div>
        </div>
    </div>
@endsection
