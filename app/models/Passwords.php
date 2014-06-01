<?php

class Passwords extends Eloquent {

	public $incrementing = false;
	protected $table = 'passwords';

	public function users()
    {
        return $this->belongsToMany('User', 'password_user', 'password_id', 'user_id');
    }
}