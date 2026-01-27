<?php

class Response
{

    public static function error(int $code, string $message, string $details)
    {

        http_response_code($code);
        header('Content-Type: application/json; charset=utf-8');

        return json_encode([
            "status" => "error",
            "error" => [
                "code" => $code,
                "message" => $message,
                "details" => $details
            ]
        ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }


    public static function success(int $code = 200, array $data = [])
    {
        http_response_code($code);
        header('Content-Type: application/json; charset=utf-8');

        return json_encode([
            "status" => "success",
            "code"   => $code,
            "data"   => $data
        ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }
}
