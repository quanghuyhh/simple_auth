<?php

namespace App\Core;

class Hash
{
    public static function check($input, $compare): bool
    {
        return static::make($input) === $compare;
    }

    public static function make(string $input): string
    {
        return encrypt($input);
    }
}