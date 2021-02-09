@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="jumbotron">
            <h1>Admin Dashboard</h1>
        </div>
        <div class="col-md-12">
            <a href="{{ route('blogs.create') }}" class="text-white btn btn-primary btn-margin-right">Create Blog</a>

            <a href="{{ route('blogs.trash') }}" class="text-white btn btn-danger btn-margin-right">Trashed Blogs</a>

            <a href="{{ route('categories.create') }}" class="text-white btn btn-success btn-margin-right">Create
                categories</a>

            <a href="{{ route('admin.blogs') }}" class="text-white btn btn-primary btn-margin-right">Manage blogs</a>
        </div>
    </div>
@endsection