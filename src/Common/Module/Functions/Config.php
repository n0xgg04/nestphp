<?php

    namespace Common\Module\Functions;

    class Config
    {
        static public function from(array $controller, array $provider): array
        {
            return [
                "controller" => $controller,
                "provider" => $provider
            ];
        }
    }
