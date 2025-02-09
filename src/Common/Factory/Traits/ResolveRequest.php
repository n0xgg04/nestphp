<?php
    namespace Common\Factory\Traits;
    use Common\Core\Container;
    use Common\Core\RouteGo;
    use Common\Http\Enums\HttpMethod;
    use Common\Http\Request;
    use Common\Http\Response;
    use function Common\Helpers\Utils\response;

    trait ResolveRequest{

        public function resolveIncomingRequest()
        {
           $container = Container::getInstance();
              $container->bind(Request::class, fn () => new Request());
              $container->bindIf(Response::class, fn () => new Response());
        }

        /**
         * @throws \ReflectionException
         */
        public function routing(){
            $incomingPath = \request()->path;
            $incomingMethod = strtoupper(\request()->method);
            $route = RouteGo::instant()->getRoute(path: $incomingPath, method: HttpMethod::tryFrom($incomingMethod) ?? "GET");
            if($route){
                $class = $route->class;
                $method = $route->method;
                $controller = \container()->make($class);
                //response html
                response()->execute(fn() => $controller->$method());
            }else{
                echo "Route not found for $incomingPath";
            }
        }
    }
