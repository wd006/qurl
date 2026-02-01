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

    public static function getIpHash()
    {
        return hash_hmac('sha256', self::getRealIp(), $_ENV['IP_SALT']);
    }

    protected static function getRealIp()
    {
        if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
            // cloudflare ip
            return $_SERVER["HTTP_CF_CONNECTING_IP"];
        }
        // general proxy header
        elseif (isset($_SERVER["HTTP_X_FORWARDED_FOR"])) {
            // the 1st IP on the list
            $ip_list = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
            return trim($ip_list[0]);
        }
        // standard
        else {
            return $_SERVER["REMOTE_ADDR"] ?? 'unknown';
        }
    }
}
