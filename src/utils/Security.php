<?php

class Security
{
    public static function hasher(string $password): string
    {

        return password_hash($password, PASSWORD_DEFAULT);
    }
}
