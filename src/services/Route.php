<?php

class Route
{
    public $route;

    public function __construct()
    {

        $requestUri = $_SERVER['REQUEST_URI'] ?? '/'; // current path

        $uri = parse_url($requestUri, PHP_URL_PATH);
        $uriString = $uri ?? ''; 

        $normalized = preg_replace('#/+#', '/', $uriString);

        $clean = trim($normalized, '/');

        $this->route = '/' . $clean;
    }

    public function getRoute()
    {
        return $this->route;
    }
}
