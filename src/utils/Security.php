<?php

class Security
{
    public static function hasher(string $password): string
    {

        return password_hash($password, PASSWORD_DEFAULT);
    }

    public static function verifier(string $password, string $hash)
    {
        return password_verify($password, $hash);
    }
}
