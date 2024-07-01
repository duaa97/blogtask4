@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="d-flex justify-content-between mb-3">
                <h2>Tags</h2>
                <a href="{{ route('tags.create') }}" class="btn btn-primary">Create Tag</a>
            </div>

            <div class="row">
                @foreach($tags as $tag)
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">{{ $tag->name }}</h5>
                            <a href="{{ route('tags.edit', $tag->id) }}" class="btn btn-secondary">Edit</a>
                            <form action="{{ route('tags.destroy', $tag->id) }}" method="POST" class="d-inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
