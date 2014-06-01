<?php

class JWTRefreshFilter {

	public function filter()
	{
		return JWTAuth::refreshToken();
	}
}