@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="jumbotron">
            @if(Auth::user() && Auth::user()->role_id === 1)
                <h1>Admin Dashboard</h1>
            @elseif(Auth::user()  && Auth::user()->role_id === 2)
                <h1>Author Dashboard</h1>
            @elseif(Auth::user()  && Auth::user()->role_id === 3)
                <h1>User Dashboard</h1>
            @endif
        </div>
        <div class="col-md-12">
            @if(Auth::user() && Auth::user()->role_id === 1)
                <a href="{{ route('blogs.create') }}" class="text-white btn btn-primary btn-margin-right">Create
                    Blog</a>
                <a href="{{ route('blogs.trash') }}" class="text-white btn btn-danger btn-margin-right">Trashed
                    Blogs</a>
                <a href="{{ route('categories.create') }}" class="text-white btn btn-success btn-margin-right">Create
                    categories</a>
                <a href="{{ route('admin.blogs') }}" class="text-white btn btn-primary btn-margin-right">Manage
                    blogs</a>
            @endif
            @if(Auth::user() && Auth::user()->role_id === 2)
                <a href="{{ route('blogs.create') }}" class="text-white btn btn-primary btn-margin-right">Create
                    Blog</a>
                <a href="{{ route('categories.create') }}" class="text-white btn btn-success btn-margin-right">Create
                    categories</a>
            @endif
            @if(Auth::user() && Auth::user()->role_id === 3)

            @endif
        </div>
    </div>
@endsection