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

Route::post('/login', function()
{
    if (Auth::attempt(array('email' => Input::get('email'), 'password' => Input::get('password')))){

        $jwt = JWTAuth::buildToken(Auth::user()->id);

    	$response = array('error' => 0, 'exp' => JWTAuth::getExpiration(), 'jwt' => $jwt);
    }
    else {
        $response = array('error' => 1, 'msg' => 'Authentication Failed');
    }

    echo json_encode($response);
});

Route::post('/logout', function()
{
    // need to add look up for the actual user since session is not shared with CORS
	Auth::logout();
});

Route::resource('passwords', 'PasswordController');