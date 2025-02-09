<?php
if (!function_exists("current_route")) {
    function current_route(): string
    {
        $requestUri = $_SERVER["REQUEST_URI"] ?? "/";
        $scriptName = $_SERVER["SCRIPT_NAME"] ?? "";

        $route = parse_url($requestUri, PHP_URL_PATH);

        if (str_starts_with($route, basename($scriptName))) {
            $route = substr($route, strlen(basename($scriptName)));
        }

        return trim($route, "/");
    }
}
