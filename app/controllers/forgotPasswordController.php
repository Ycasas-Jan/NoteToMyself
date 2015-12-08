<?php

class forgotPasswordController extends \BaseController
{

    public function index()
    {
         return View::make('forgotPassword'); //show home page
    }

    public function failure($exitMsg){
        echo $exitMsg;
        return Redirect::back()->withInput();
    }

    public function store()
    {
        if (!Input::has('email')){
            $this->failure("Must fill in the values");
        }

        $rules = array('email' => 'unique:users,email');
        $validator = Validator::make(Input::all(), $rules);
        if (!$validator->fails()) {
            $this->failure('ERROR. NOT IN DATABASE');
        }
        $newPass = time();
        User::where('email',Input::get('email'))->update(array('password' => Hash::make($newPass)));

        Mail::send('emails.emailNewPass', array('code' => $newPass), function($message) {
            $message->to('ycasas.jan@gmail.com', 'Jan Ycasas')->subject('New Password!');
        });

        return Redirect::to('/');
    }

}
