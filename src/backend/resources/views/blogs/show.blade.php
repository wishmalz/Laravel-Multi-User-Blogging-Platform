@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <article>
            <div class="jumbotron">
                <div class="col-md-12">
                    <h1>{{ $blog->title }}</h1>
                </div>

                <div class="col-md-12">
                    <div class="btn-group">
                        <a href="{{ route('blogs.edit', $blog->id) }}"
                           class="btn btn-primary btn-sm btn-margin-right">Edit </a>

                        <form action="{{ route('blogs.delete', $blog->id) }}" method="POST">
                            {{ method_field('delete') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <p>{{ $blog->body }}</p>
            </div>
        </article>
    </div>
@endsection