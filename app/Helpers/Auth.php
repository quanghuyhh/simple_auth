<?php

namespace App\Helpers;

class Auth
{
    public static function check(): bool
    {
        return !empty(session('user'));
    }

    public static function redirectIf(bool $condition = false, string $path = '/')
    {
        if (!$condition) {
            return;
        }
        redirect($path);
    }
}