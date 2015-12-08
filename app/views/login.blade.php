@extends('layouts.master')

@section('nameOfPage', 'Home')

@section('title')
    <h1>Note To Myself</h1>
@endsection

@section('content')
    <div class="container">
    {{Form::open(['route'=>'store'])}}
        <div class="row">
            <div class="col-md-2">
                {{Form::label('emailText', 'Email Address:')}}
            </div>
            <div class="col-md-6">
            {{Form::email('email',$email,array('required' => 'required'))}}
            </div>
        </div>

        <div class="row">
            <div class="col-md-2">
                {{Form::label('passwordText', 'Password:')}}
            </div>
            <div class="col-md-6">
                {{Form::password('password',array('required' => 'required'))}}
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                {{Form::submit('Log in')}}
            </div>
        </div>
    {{Form::close()}}
    <a href="register">Register</a> | <a href="forgotPassword">Forgot Password</a>
    </div>
@endsection



