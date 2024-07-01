@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="d-flex justify-content-between mb-3">
                <h2>Posts</h2>
                <a href="{{ route('posts.create') }}" class="btn btn-primary">Create Post</a>
            </div>

            <div class="row">
                @foreach($posts as $post)
                <div class="mb-3">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <span>{{ $post->category->title }} > {{ $post->title }}</span>
                            <span class="d-flex">
                                @if(Auth::check() && (Auth::user()->id == $post->user_id || Auth::user()->is_admin))
                                <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-sm btn-primary mx-1">Edit</a>
                                <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger mx-1">Delete</button>
                                </form>
                                @endif
                            </span>
                        </div>
                        <a href="{{ route('posts.show', $post->id) }}" class="text-decoration-none text-dark">
                            <div class="card-body">
                                <p class="card-text">{{ $post->content }}</p>
                                <img src="{{ asset('storage/' . $post->image) }}" class="img-fluid mb-2" alt="{{ $post->title }}">
                                <p class="card-text">
                                    <strong>Tags:</strong>
                                    @foreach($post->tags as $tag)
                                    <span class="badge badge-primary">{{ $tag->name }}</span>
                                    @endforeach
                                </p>
                            </div>
                        </a>
                        <div class="card-footer">
                            <small class="text-muted">Posted by {{ $post->user->name }} on {{ $post->created_at->format('d M Y') }}</small>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
