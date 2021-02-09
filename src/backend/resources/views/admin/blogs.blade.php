@extends('layouts.app')

@include('partials.meta_static')

@section('content')
    <div class="container-fluid">
        <div class="jumbotron">
            <h1>Manage blogs</h1>
        </div>
        <div class="row">
            <div class="col-md-6">
                <h3>Published blogs</h3>
                <hr>
                @foreach($publishedBlogs as $blog)
                    <h2><a href={{ route('blogs.show', [$blog->id]) }}>{{ $blog->title }}</a></h2>
                    {!! str_limit($blog->body, 100) !!}

                    <form action="{{ route('blogs.update', $blog->id) }}" method="POST">
                    {{ method_field('patch') }}
                    {{ csrf_field() }}
                        <input type="checkbox" value="0" checked name="status" style="display:none;">
                        <button type="submit" class="btn btn-sm btn-warning">Save as draft</button>
                    </form>
                @endforeach
            </div>
            <div class="col-md-6">
                <h3>Draft blogs</h3>
                <hr>
                @foreach($draftBlogs as $blog)
                    <h2><a href={{ route('blogs.show', [$blog->id]) }}>{{ $blog->title }}</a></h2>
                    {!! str_limit($blog->body, 100) !!}

                    <form action="{{ route('blogs.update', $blog->id) }}" method="POST">
                        {{ method_field('patch') }}
                        {{ csrf_field() }}
                        <input type="checkbox" value="1" checked name="status" style="display:none;">
                        <button type="submit" class="btn btn-sm btn-success">Save as published</button>
                    </form>
                @endforeach
            </div>
        </div>
    </div>
@endsection