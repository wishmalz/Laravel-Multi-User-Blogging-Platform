@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="jumbotron">
            <h1>Contact page</h1>
        </div>
        <div class="col-md-12">
            <form action="{{ route('mail.send') }}" method="POST">
                {{ csrf_field() }}
                Name<input type="text" name="name" class="form-control">
                Email<input type="text" name="email" class="form-control">
                Subject<input type="text" name="subject" class="form-control">
                Msg<textarea type="text" name="mail_message" class="form-control"></textarea>
                <button class="btn btn-sm btn-success form-control" type="submit">Send</button>
            </form>
        </div>
    </div>
@endsection