<?php

class loginController extends \BaseController
{

    public function index()
    {
        if (Auth::check()) {
            //re;turn "Logged in as " . Auth::user()->email
            return Redirect::to('profile');
        } else {
            $cookie = "";
            if(isset($_COOKIE["email"])) {
                $cookie = $_COOKIE["email"];
            }
            return View::make('login')->with('email',$cookie); //show home page
        }
    }


    public function store()
    {
        $verification = User::select('verification')->where('email',Input::get('email'))->first()->toArray();
        $verification = $verification['verification'];
        if($verification != '') {
            echo "NOT VALID PLZ VERIFY";
            return Redirect::back()->withInput();
        }

        $curCount = User::select('count')->where('email',Input::get('email'))->first()->toArray();
        $curCount = $curCount['count'];

        if($curCount >= 3) {
            echo "LOCKED <br />";
            $newPass = 'newPass';
            User::where('email',Input::get('email'))->update(array('password' => Hash::make($newPass)));

            Mail::send('emails.emailBreak', array('code' => $newPass,'email' => Input::get('email'))
                , function($message) {
                    $message->to('ycasas.jan@gmail.com', 'Jan Ycasas')->subject('ACCOUNT LOCKED!');
            });
            return Redirect::back()->withInput();
        }

        // only pass the email address and the password; nothing else
        if(Auth::attempt(Input::only('email', 'password'),true)) {
            User::where('email',Input::get('email'))->update(array('count' => 0));
            /* WORKING WITHOUT COOKIES
             * return Redirect::to('/profile');
             */
            setcookie('email', Input::get('email'), time() + (86400 * 30), "/");

            return Redirect::to('/profile');
        }

        echo "INVALID LOGIN ";
        $curCount = $curCount + 1;
        User::where('email',Input::get('email'))->update(array('count' => $curCount));
        return Redirect::back()->withInput();
    }

}
