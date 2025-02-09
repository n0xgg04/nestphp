<?php

namespace Common\Module\Functions;

class Config
{
    public static function from(array $controller, array $provider): array
    {
        return [
            "controller" => $controller,
            "provider" => $provider,
        ];
    }
}
