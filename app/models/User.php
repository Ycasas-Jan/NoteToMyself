<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

    public $timestamps = false;

    protected $fillable = ['emailaddress', 'password'];

    use UserTrait, RemindableTrait;

    protected $table = 'users';

    public $messages;

    protected $hidden = array('password');

    public static $rules = [
        'emailaddress'=>'required',
        'password'=>'required|min:2|max:80'];

    public function isValid()
    {
        $v = Validator::make($this->attributes, static::$rules);

        if($v->passes())
        {
            return true;
        }

        $this->messages = $v->messages();
        return false;
    }
}
