<?php

class Captaha {
    private static $secretKey = $_ENV['TURNSTILE_SECRET_KEY'] ?? '';

    public static function verify($token) {
        if (empty($token)) return false;

        $url = "https://challenges.cloudflare.com/turnstile/v0/siteverify";
        
        $data = [
            'secret'   => self::$secretKey,
            'response' => $token,
            'remoteip' => $_SERVER['REMOTE_ADDR']
        ];

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        
        $response = curl_exec($ch);
        curl_close($ch);

        $result = json_decode($response, true);
        
        return isset($result['success']) && $result['success'] === true;
    }
}