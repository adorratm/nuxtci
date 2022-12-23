<?php

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class AUTHORIZATION
{
    public static function validateTimestamp($token)
    {
        $CI = &get_instance();
        $token = self::validateToken($token);
        if ($token != false && (now() - $token->timestamp < ($CI->config->item('token_timeout')))) {
            return $token;
        }
        return false;
    }

    public static function validateToken($token)
    {
        $CI = &get_instance();
        return JWT::decode($token, new Key($CI->config->item('jwt_key'), 'HS256'));
    }

    public static function generateToken($data)
    {
        $CI = &get_instance();
        return JWT::encode($data, $CI->config->item('jwt_key'), 'HS256');
    }

    public static function verifyHeaderToken()
    {
        $CI = &get_instance();
        $decodedToken = false;
        $headers = $CI->input->request_headers();
        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            //TODO: Change 'token_timeout' in application\config\jwt.php
            $token = str_replace("Bearer ", '', $headers["Authorization"]);
            if (!empty($token) && str_contains($headers["Authorization"], "Bearer ")) {
                $decodedToken = AUTHORIZATION::validateTimestamp($token);
            }
        }
        return $decodedToken;
    }
}
