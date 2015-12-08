<?php

class resetPasswordController extends \BaseController
{
    public function resetPass($email){
        return View::make('resetPass')->with('email',$email);
    }

    public function confirm(){
        if(Input::get('password') != Input::get('confirmPassword')){
            exit("ERROR PASSWORD NOT THE SAME");
        }
        User::where('email',Input::get('email'))->update(array(
            'password' => Hash::make(Input::get('password')),
            'count' => 0
        ));
        echo "<a href='\'>Log In</a>";
    }

}
