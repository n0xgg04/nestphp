<?php
    namespace Common\Core;

    use Common\Core\Routing\Route;
    use Common\Http\Enums\HttpMethod;

    class RouteGo
    {
        private static RouteGo $instance;
        private array $routes = [];

        private function __construct() {}

        public function addRoute(string $route, HttpMethod $routeMethod, string $class, string $method): void
        {
            $this->routes[] = new Route($route, $routeMethod, $class, $method);
        }

        public function getRouteByPath(string $path): ?Route
        {
            return array_find($this->routes, fn($route) => $route->route === $path);
        }

        public function getRoute(string $path, HttpMethod $method): ?Route
        {
            $filteredRoutes = array_filter($this->routes, fn($route) => $route->route === $path && $route->routeMethod === $method);
            return !empty($filteredRoutes) ? reset($filteredRoutes) : null;
        }

        public function allRoutes(): array
        {
            return $this->routes;
        }

        public static function instant(): RouteGo
        {
            if (!isset(self::$instance)) {
                self::$instance = new RouteGo();
            }
            return self::$instance;
        }
    }
