<?php

class ProfileController extends \BaseController {

	public function __construct()
	{
		$this->jwt = JWT::decode($_SERVER['HTTP_X_JWT_AUTH_TOKEN'], Config::get('app.key'));
		$this->beforeFilter('jwt.auth');
		$this->afterFilter('jwt.refresh');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//echo json_encode(array('error' => 1, 'msg' => 'Record was not found.'));
		$user = User::find($this->jwt->uid);
		//$user = User::find('6d93a24f-d588-4a9e-80d4-4e821f53421e');

		if ($user) {
			echo json_encode(array('error' => 0, 'data' => $user->toArray()));
		}
		else {
			echo json_encode(array('error' => 1, 'msg' => 'Record was not found.'));
		}
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update()
	{
		$user = User::find($this->jwt->uid);

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
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
