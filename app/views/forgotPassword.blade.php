@extends('layouts.master')

@section('nameOfPage', 'Forgot Password')

@section('title')
    <h1>Forgot Password</h1>
@endsection

@section('content')
    <div class="container">
        {{Form::open(['route'=>'forgotPassword.store'])}}
        <div class="row">
            <div class="col-md-2">
                {{Form::label('emailText', 'Email Address:')}}
            </div>
            <div class="col-md-6">
                {{Form::email('email')}}
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                {{Form::submit('Submit')}}
            </div>
        </div>
        {{Form::close()}}
    </div>
@endsection



