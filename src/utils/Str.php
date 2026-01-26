<?php

class Str
{

    public static function random(int $length): string
    {

        $bytes = ceil($length / 2);
        return substr(bin2hex(random_bytes($bytes)), 0, $length);
    }

}
