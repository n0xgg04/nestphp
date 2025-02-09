<?php
    namespace Common\Factory\Traits;

    use Common\Core\RouteGo;
    use Common\Http\Enums\HttpMethod;
    use Common\Routing\Annotations\Controller;
    use ReflectionClass;
    use ReflectionException;

    trait ResolveController{
        /**
         * @throws ReflectionException
         */
        private function resolveController($controllers): void
        {
            $routes = RouteGo::instant();
            foreach ($controllers as $controller) {
                $this->serviceContainer->bindIf($controller, fn () => new $controller());
                //! Resolve all routes
                $controllerReflect = new ReflectionClass($controller);
                //! Get Controller attribute
                $prefix = "";
                $controllerAttribute = $controllerReflect->getAttributes(Controller::class);
                if (!empty($controllerAttribute)) {
                    $instant = $controllerAttribute[0]->newInstance();
                    if (isset($instant->prefix)) {
                        $prefix = $instant->prefix;
                    }
                }
                $methods = $controllerReflect->getMethods();
                foreach ($methods as $method) {
                    $methodAttributes = $method->getAttributes();
                    foreach ($methodAttributes as $methodAttribute) {
                        $methodAttributeInstance = $methodAttribute->newInstance();
                        $route = $prefix . $methodAttributeInstance->path;
                        $controllerMethod = $method->getName();

                        $attributeClass = $methodAttribute->getName();
                        $parts = explode("\\", $attributeClass);
                        $requestMethod = HttpMethod::from(strtoupper(array_pop($parts)));

                        $routes->addRoute(route: $route, routeMethod: $requestMethod, class: $controller, method: $controllerMethod);
                    }
                }
            }
        }
    }
