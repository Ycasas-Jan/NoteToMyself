<?php

class passwordController extends \BaseController
{
    public function verify($verification,$email){
        User::where('email',$email)->update(array('verification' => ''));
        echo "Verification Complete <a href='/'>Log In</a>";
    }
}
