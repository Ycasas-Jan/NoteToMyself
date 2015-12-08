<?php

class registerController extends \BaseController
{
    public function failure($exitMsg){
        exit($exitMsg);
        return Redirect::to("forgotPassword");
    }
    public function create()
    {
        if(Auth::check()) // opposite of Auth::guest()
        {
            //return Redirect::to('/mainpage');

        }
        //return View::make('sessions.create'); // form
        //return View::make('login'); // form

    }

    public function index()
    {
        return View::make('register');
    }


    public function store() {
        if (!Input::has('email','password','confirmPassword')){
            $this->failure("Must fill in the values");
        }
        if(Input::get('password') != Input::get('confirmPassword')){
            $this->failure("PASSWORDS NOT THE SAME");
        }

        $rules = array('email' => 'unique:users,email');
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            $this->failure('That email address is already registered. You sure you don\'t have an account?');
        }

        if(!(filter_var(Input::get('email'), FILTER_VALIDATE_EMAIL))){
            $this->failure("username must be an email");
        }
        $verificationCode = md5(time());

        User::insert(array('email'=>Input::get('email'),'password' => Hash::make(Input::get('password'))
            ,'verification' => $verificationCode));

        Image::insert(array(
            'email' =>Input::get('email'),
            'image' => ''
        ));

        Notes::insert(array(
            'email' =>Input::get('email'),
            'notes' => ''
        ));

        TBD::insert(array(
            'email' =>Input::get('email'),
            'tbd' => ''
        ));

        Links::insert(array(
            'email' =>Input::get('email'),
            'links' => ''
        ));

        Mail::send('emails.emailMessage', array('code' => $verificationCode, 'email' => Input::get('email')), function($message) {
            $message->to('ycasas.jan@gmail.com', 'Jan Ycasas')->subject('Welcome!');
        });
        echo "Go Log In";
        return Redirect::to('/');

    }

    public function destroy()
    {

    }


}
