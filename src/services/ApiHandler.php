<?php

class ApiHandler
{
    public function handle($uri)
    {

        header('Content-Type: application/json; charset=utf-8');

        $apiPath = str_replace('api/', '', $uri);
        $apiPath = trim($apiPath, '/');

        $apiFile = ROOTDIR . '/src/api/' . $apiPath . '.php';

        if (file_exists($apiFile)) {

            require_once $apiFile;
        } else {

            http_response_code(404);
            echo json_encode([
                "status" => "error",
                "message" => "API endpoint not found: " . $apiPath
            ]);
        }

        exit;
    }
}
