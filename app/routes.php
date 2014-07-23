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

/*Route::get('/profile', array('before' => 'jwt.auth', 'do' => function()
{
    $jwt = JWT::decode($_SERVER['HTTP_X_JWT_AUTH_TOKEN'], Config::get('app.key'));

    $user = User::find($jwt->uid)->toArray();

    $response = array('error' => 0, 'user' => $user);

    echo json_encode($response);
}));

Route::post('/profile', array('before' => 'jwt.auth', 'do' => function()
{
    $jwt = JWT::decode($_SERVER['HTTP_X_JWT_AUTH_TOKEN'], Config::get('app.key'));

    $user = User::find($jwt->uid);

    $user->first_name  = Input::get('first_name');
    $user->last_name   = Input::get('last_name');
    $user->email       = Input::get('email');

    if (1==2) {
        $user->password = Hash::make(Input::get('new_password'));
    }

    if ($user->save()) {
        echo json_encode(array('error' => 0));
    }
    else {
        echo json_encode(array('error' => 1, 'msg' => 'There was a problem saving the record.'));
    }

    echo json_encode(array('error' => 0));
}));*/

Route::resource('passwords', 'PasswordController');

Route::resource('profile', 'ProfileController');