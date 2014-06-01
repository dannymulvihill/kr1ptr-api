<?php

class PasswordController extends \BaseController {

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
		//echo User::find($this->jwt->uid)->passwords->toJson();
		$passwords = User::find($this->jwt->uid)->passwords->toArray();
		echo json_encode(array('error' => 0, 'data' => $passwords));
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$pass = new Passwords();

		$pass->id              = UUID::v4();
		$pass->name            = Input::get('name');
		$pass->host            = Input::get('host');
		$pass->username        = Input::get('username');
		$pass->password        = Input::get('password');
		$pass->notes           = Input::get('notes');
		$pass->encrypted_notes = Input::get('encrypted_notes');

		$pivot = array(
			'is_owner' => 1,
			'can_edit' => 1,
			'can_delete' => 1,
			'can_share' => 1,
		);

		if (User::find($this->jwt->uid)->passwords()->save($pass, $pivot)) {
			echo json_encode(array('error' => 0, 'id' => $pass->id));
		}
		else {
			echo json_encode(array('error' => 1, 'msg' => 'There was a problem saving the record.'));
		}
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$pass = User::find($this->jwt->uid)->passwords->find($id)->toArray();

		if ($pass) {
			echo json_encode(array('error' => 0, 'data' => $pass));
		}
		else {
			echo json_encode(array('error' => 1, 'msg' => 'Record was not found.'));
		}
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$pass = User::find($this->jwt->uid)->passwords->find($id);

		$pass->name            = Input::get('name');
		$pass->host            = Input::get('host');
		$pass->username        = Input::get('username');
		$pass->password        = Input::get('password');
		$pass->notes           = Input::get('notes');
		$pass->encrypted_notes = Input::get('encrypted_notes');

		if ($pass->save()) {
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
		User::find($this->jwt->uid)->passwords->destroy($id);
	}
}