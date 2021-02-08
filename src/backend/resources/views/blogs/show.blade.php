@extends('layouts.app')

@section('content')

@section('meta_title'){{ $blog->meta_title }}
@endsection

@section('meta_description'){{ $blog->meta_description }}
@endsection

    <div class="container-fluid">
        <article>
            <div class="jumbotron">

                <div class="col-md-12">
                    @if($blog->featured_img)
                        <img src="/images/featured_imgs/{{ $blog->featured_img ? : '' }}" alt="{{ str_limit
                        ($blog->title, 50)
                        }}" class="img-fluid">
                    @endif
                </div>

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
                {!! $blog->body !!}
                <strong>Categories: </strong>
                @foreach($blog->category as $category)
                    <span><a href="{{ route('categories.show', $category->slug) }}">{{ $category->name }}</a></span>
                @endforeach
            </div>
        </article>
    </div>
@endsection