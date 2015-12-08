<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Image extends Eloquent implements UserInterface, RemindableInterface {

    public $timestamps = false;

    use UserTrait, RemindableTrait;

    protected $table = 'images';

}
