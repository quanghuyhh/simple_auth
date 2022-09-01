<?php

namespace App\Core;

use App\Helpers\Arr;
use App\Models\User;
use Carbon\Carbon;
use Firebase\JWT\JWT as JWTEngine;
use Firebase\JWT\Key as JWTKey;

class JWT
{
    private static string $key;
    private static array $payload;
    private static string $type;

    public function __construct()
    {
    }

    public static function encode(array $userData): string
    {
        static::init();
        $params = array_merge(
            static::$payload,
            Arr::only($userData, ['email', 'hash_id']),
            [
                'exp' => Carbon::now()->addDays(env('JWT_EXPIRE_DAYS', 1))
            ]
        );
        return JWTEngine::encode($params, static::$key, static::$type);
    }

    public static function decode(string $jwt): array
    {
        static::init();
        return (array) JWTEngine::decode($jwt, new JWTKey(static::$key, static::$type));
    }

    public static function init()
    {
        static::$key = env('JWT_KEY');
        static::$payload = [
            'iss' => env('APP_URL'),
            'aud' => env('APP_URL'),
            'iat' => time(),
            'nbf' => time()
        ];
        static::$type = 'HS256';
    }
}