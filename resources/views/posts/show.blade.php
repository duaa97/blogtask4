@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>
                    {{ $post->title }}
                </span>
                <span class="d-flex">
                @if(Auth::check() && (Auth::user()->id == $post->user_id || Auth::user()->is_admin))
                        <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-sm btn-primary ">Edit</a>
                        <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                        @endif
                </span>
                </div>
                <div class="card-body">
                    <p class="card-text">Category: {{ $post->category->title }}</p>
                    <p class="card-text">{{ $post->content }}</p>
                    @if($post->image)
                    <img src="{{ asset('storage/' . $post->image) }}" class="img-fluid mt-3" alt="{{ $post->title }}">
                    @endif
                        <p class="card-text">
                            @foreach($post->tags as $tag)
                            <span class="badge badge-primary">{{ $tag->name }}</span>
                            @endforeach
                        </p>
                    <p class="mt-3">
                        <small>By {{ $post->user->name }} on {{ $post->created_at->format('d M Y') }}</small>
                    </p>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-header">{{ __('Comments') }}</div>
                <div class="card-body">
                    @foreach($post->comments as $comment)
                    <div class="media mb-3">
                        <div class="media-body">
                            <h5 class="mt-0">{{ $comment->user->name }}</h5>
                            <p>{{ $comment->content }}</p>
                            <small class="text-muted">{{ $comment->created_at->format('d M Y') }}</small>
                            @if(auth()->check() && (auth()->user()->id == $comment->user_id || auth()->user()->id == $post->user_id))
                            <div class="mt-2">
                                @if(auth()->user()->id == $comment->user_id)
                                <a href="{{ route('comments.edit', $comment->id) }}" class="btn btn-secondary btn-sm">Edit</a>
                                @endif
                                <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" class="d-inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endforeach

                    @auth
                    <form method="POST" action="{{ route('comments.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="content">{{ __('Add Comment') }}</label>
                            <textarea id="content" class="form-control @error('content') is-invalid @enderror" name="content" rows="3" required></textarea>
                            @error('content')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <input type="hidden" name="post_id" value="{{ $post->id }}">
                        <button type="submit" class="btn btn-primary">{{ __('Post Comment') }}</button>
                    </form>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
