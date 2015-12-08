<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::resource('profile','profileController');


Route::resource('/','loginController');
Route::resource('register','registerController');
Route::resource('forgotPassword','forgotPasswordController');

Route::get('verify/{code?}/{email?}', 'passwordController@verify');
Route::get('resetPass/{email?}','resetPasswordController@resetPass');
Route::post('resetPass/confirm','resetPasswordController@confirm');



