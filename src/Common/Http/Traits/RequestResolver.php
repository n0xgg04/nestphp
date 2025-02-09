<?php
namespace Common\Http\Traits;

trait RequestResolver
{
    public function getMethod()
    {
        return $_SERVER["REQUEST_METHOD"];
    }
}
