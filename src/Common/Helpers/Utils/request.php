<?php

    use Common\Http\Request;

    if (!function_exists("request")) {
        /**
         * @throws ReflectionException
         */
        function request(): Request
        {
            return container()->make(Request::class);
        }
    }
