@extends('layouts.master')

@section('nameOfPage', 'Register')

@section('title')
    <h1>Register</h1>
@endsection
<script src='https://www.google.com/recaptcha/api.js'></script>
@section('content')
    <div class="container">
        {{Form::open(['route'=>'register.store'])}}
        <div class="row">
            <div class="col-md-2">
                {{Form::label('emailText', 'Email Address:')}}
            </div>
            <div class="col-md-6">
                {{Form::email('email')}}
            </div>
        </div>

        <div class="row">
            <div class="col-md-2">
                {{Form::label('passwordText', 'Password:')}}
            </div>
            <div class="col-md-6">
                {{Form::password('password')}}
            </div>
        </div>

        <div class="row">
            <div class="col-md-2">
                {{Form::label('passwordText', 'Confirm Password:')}}
            </div>
            <div class="col-md-6">
                {{Form::password('confirmPassword')}}
            </div>
        </div>
        <div class="row">
            <div class="col-md-2 g-recaptcha" data-sitekey="6Ld1LBITAAAAAIevnAzSNYc9MLwHVaFjhJdILDwN"></div>
        </div>

        <div class="row">
            <div class="col-md-12">
                {{Form::submit('Register')}} or <a href=".\">Log In</a>
            </div>
        </div>
        {{Form::close()}}
    </div>
@endsection

