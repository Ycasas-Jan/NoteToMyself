@extends('layouts.master')

@section('nameOfPage', 'Input New Password')

@section('title')
    <h1>Input New Password</h1>
@endsection

@section('content')
    <form action="/resetPass/confirm" method="post">
        <div class="form-group">
            <input type="password" name="password" class="form-control" placeholder="Password">
        </div>
        <div class="form-group">
            <input type="password" name="confirmPassword" class="form-control" placeholder="Confirm Password">
            <input type="hidden" name="email" class="form-control" value="{{$email}}">
        </div>
        <button type="submit" name="submit" class="btn btn-default">Submit</button>
    </form>
@endsection



