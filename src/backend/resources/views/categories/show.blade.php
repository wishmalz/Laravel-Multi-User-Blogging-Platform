@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="jumbotron">
            <h1>{{ $category->name }}</h1>
            <div class="btn-group">
                <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-warning">Edit</a>

                <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
                    {{ method_field('delete') }}
                    {{ csrf_field() }}
                    <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                </form>
            </div>
        </div>

        <div class="col-md-12">
            @foreach($category->blog as $blog)
                <h3><a href="{{ route('blogs.show', $blog->id) }}">{{ $blog->title }}</a></h3>
            @endforeach
        </div>
    </div>
@endsection