@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="jumbotron">
            <h1>Edit blog</h1>
        </div>

        <div class="col-md-12">
            <form action="{{ route('blogs.update', $blog->id) }}" method="POST">
                {{ method_field('patch') }}
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" class="form-control" value="{{ $blog->title }}">
                </div>
                <div class="form-group">
                    <label for="body">Body</label>
                    <textarea name="body" class="form-control">{!! $blog->body !!}</textarea>
                </div>

                <div class="form-group form-check form-check-inline">
                    @foreach($blog->category as $category)
                        <input type="checkbox" value="{{ $category->id }}" name="category_id[]"
                               class="form-check-input" checked>
                        <label for="" class="form-check-label btn-margin-right"> {{ $category->name }}</label>
                    @endforeach
                </div>
                <div class="form-group form-check form-check-inline">
                    @foreach($filtered as $category)
                        <input type="checkbox" value="{{ $category->id }}" name="category_id[]"
                               class="form-check-input">
                        <label for="" class="form-check-label btn-margin-right"> {{ $category->name }}</label>
                    @endforeach
                </div>
                <div>
                    <button class="btn btn-primary" type="submit">Update blog</button>
                </div>
            </form>
        </div>
    </div>
@endsection
