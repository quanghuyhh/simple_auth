<?php

namespace App\Helpers;

use App\Core\JWT;
use App\Core\Response;
use App\Models\User;

class Auth
{
    public static function check(): bool
    {
        return !empty(static::getAuth());
    }

    public static function redirectIf(bool $condition = false, string $path = '/')
    {
        if (!$condition) {
            return;
        }
        redirect($path);
    }

    public static function needAuth(bool $condition = false)
    {
        if (!$condition) {
            response([], Response::HTTP_UNAUTHORIZED)->json();
            exit();
        }
    }

    public static function getAuthorizationHeader(): ?string
    {
        $headers = null;
        if (isset($_SERVER['Authorization'])) {
            $headers = trim($_SERVER["Authorization"]);
        }
        else if (isset($_SERVER['HTTP_AUTHORIZATION'])) { //Nginx or fast CGI
            $headers = trim($_SERVER["HTTP_AUTHORIZATION"]);
        } elseif (function_exists('apache_request_headers')) {
            $requestHeaders = apache_request_headers();
            // Server-side fix for bug in old Android versions (a nice side-effect of this fix means we don't care about capitalization for Authorization)
            $requestHeaders = array_combine(array_map('ucwords', array_keys($requestHeaders)), array_values($requestHeaders));
            if (isset($requestHeaders['Authorization'])) {
                $headers = trim($requestHeaders['Authorization']);
            }
        }
        return $headers;
    }
    /**
     * get access token from header
     * */
    public static function getBearerToken() {
        $headers = static::getAuthorizationHeader();
        // HEADER: Get the access token from the header
        if (!empty($headers)) {
            if (preg_match('/Bearer\s(\S+)/', $headers, $matches)) {
                return $matches[1];
            }
        }
        return null;
    }

    public static function getAuth()
    {
        if ($user = session('user')) {
            return $user;
        }

        if (!$token = static::getBearerToken()) {
            return null;
        }

        $payload = JWT::decode($token);
        return User::firstWhere('hash_id', $payload['hash_id'] ?? null)->toArray();
    }
}