<?php
namespace Common\Http;


class Request
{
    public string $method;
    public string $path;

    public function __construct()
    {
        $this->method = $this->getMethod();
        $this->path = $this->getPath();
    }

    private function getMethod()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    private function getPath()
    {
        $path = $_SERVER['REQUEST_URI'];
        $position = strpos($path, '?');
        if ($position === false) {
            return $path;
        }
        return substr($path, 0, $position);
    }


    public function input() {}
}
