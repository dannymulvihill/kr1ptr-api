<?php

class JWTAuth {

	public static function getExpiration()
	{
		return time() + (60 * 15);
	}

	public static function buildToken($user_id)
	{
    	$payload = array(
    		'uid' => $user_id,
    		'ipa' => Request::getClientIp(),
    		'uag' => $_SERVER['HTTP_USER_AGENT'],
    		'exp' => self::getExpiration()
    	);

    	$jwt = JWT::encode($payload, Config::get('app.key'));

    	return $jwt;
	}

	public static function validateToken()
	{
		// start the output buffer
		ob_start();

		$jwt = JWT::decode($_SERVER['HTTP_X_JWT_AUTH_TOKEN'], Config::get('app.key'));

		if ($jwt)
		{
			if ($jwt->exp < time())
			{
				return Response::json(array('error' => 1, 'msg' => 'Your access token is expired'), 403);
			}

			if ($jwt->ipa != Request::getClientIp())
			{
				return Response::json(array('error' => 1, 'msg' => 'Your IP address has changed'), 403);
			}

    		if ($jwt->uag != $_SERVER['HTTP_USER_AGENT'])
    		{
    			return Response::json(array('error' => 1, 'msg' => 'User Agent Validation failed'), 403);
    		}
		}
		else
		{
			return Response::json(array('error' => 1, 'msg' => 'Your access token is not valid'), 403);
		}
	}

	public static function refreshToken()
	{
		$jwt = JWT::decode($_SERVER['HTTP_X_JWT_AUTH_TOKEN'], Config::get('app.key'));

		// the JWT is still valid, but will expire within 5 minutes refresh it
		if (($jwt->exp < (time() + (60 * 5)) && ($jwt->exp > time())))
		{
			$output = ob_get_clean();

			$response = json_decode($output);

			$response->jwt = self::buildToken($jwt->uid);
			$response->exp = self::getExpiration();


			echo json_encode($response);
		}
	}
}