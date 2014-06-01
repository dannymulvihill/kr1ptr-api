<?php

class JWTAuthFilter {

	public function filter()
	{
		return JWTAuth::validateToken();
	}
}