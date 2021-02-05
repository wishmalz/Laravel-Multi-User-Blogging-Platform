@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <article>
            <div class="jumbotron">
                <h1><a href="{{ route('blogs.edit', $blog->id) }}" class="small">Edit </a>{{ $blog->title }}</h1>
            </div>

            <div class="col-md-12">
                <p>{{ $blog->body }}</p>
            </div>
        </article>
    </div>
@endsection