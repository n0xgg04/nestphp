<?php

    namespace Common\Core\Routing;

    use Common\Http\Enums\HttpMethod;

    class Route
    {
        public function __construct(public string $route, public HttpMethod $routeMethod, public string $class, public string $method)
        {

        }
    }
