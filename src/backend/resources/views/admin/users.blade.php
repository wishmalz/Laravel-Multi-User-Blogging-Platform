@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="jumbotron">
            <h1>Manage users</h1>
        </div>

        <div class="col-md-12">
            <div class="row">
                @foreach($users as $user)
                    <div class="col-md-4">
                        <form action="{{ route('users.update', $user->id) }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('patch') }}
                            <div class="form-group">
                                <input type="text" class="form-control" value="{{ $user->name }}" disabled name="name">
                            </div>

                            <div class="form-group">
                                <select name="role_id" id="role_id" class="form-control">
                                    <option selected>{{ ucfirst($user->role->name) }}</option>
                                    <option value="2">Author</option>
                                    <option value="3">Subscriber</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <input type="text" class="form-control" value="{{ $user->email }}" disabled
                                       name="email">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" value="{{ $user->created_at->diffForHumans() }}"
                                       disabled name="created_at">
                            </div>
                            <button class="btn btn-sm btn-success form-control" type="submit">Update</button>
                        </form>
                        <form action="{{ route('users.destroy', $user) }}">
                            {{ csrf_field() }}
                            {{ method_field('delete') }}
                            <button type="submit" class="btn btn-sm btn-danger form-control">
                                Delete
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection