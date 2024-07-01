@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">{{ __('Categories') }}</div>
                <div class="card-body">
                    <a href="{{ route('categories.create') }}" class="btn btn-primary mb-3">{{ __('Add New Category') }}</a>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">{{ __('Title') }}</th>
                                    <th scope="col">{{ __('Image') }}</th>
                                    <th scope="col">{{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($categories as $category)
                                <tr>
                                    <td>{{ $category->title }}</td>
                                    <td>
                                        @if($category->image)
                                        <img src="{{ asset('storage/' . $category->image) }}" class="img-fluid" style="max-width: 100px;" alt="{{ $category->title }}">
                                        @else
                                        {{ __('No Image') }}
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-secondary btn-sm">{{ __('Edit') }}</a>
                                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="d-inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">{{ __('Delete') }}</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
