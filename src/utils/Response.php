<?php

class Response
{
    public static function error(int $code, string $message, string $details = null): string
    {
        http_response_code($code);
        header('Content-Type: application/json; charset=utf-8');

        $response = [
            "status" => "error",
            "code"   => $code,
            "message" => $message,
            "details" => $details
        ];

        return json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    public static function success(int $code, string $message, array $data = []): string
    {
        http_response_code($code);
        header('Content-Type: application/json; charset=utf-8');

        $response = [
            "status" => "success",
            "code"   => $code,
            "message" => $message,
            "data"   => $data
        ];

        return json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }
}
