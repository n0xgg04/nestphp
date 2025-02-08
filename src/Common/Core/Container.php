<?php

    namespace Common\Core;

    use Closure;
    use ReflectionClass;
    use ReflectionException;
    use ReflectionMethod;
    use ReflectionParameter;
    use Exception;

    class Container
    {
        protected array $bindings = [];
        protected array $instances = [];
        protected array $tags = [];
        public array $contextualBindings = [];

        private function __construct()
        {
        }

        /**
         * Bind a class or interface to the container.
         * @param string $abstract
         * @param Closure|string|null $concrete
         * @param bool $singleton
         * @return void
         */
        public function bind(string $abstract, Closure|string|null $concrete = null, bool $singleton = false): void
        {
            $this->bindings[$abstract] = compact('concrete', 'singleton');
        }

        /**
         * Bind a class or interface to the container if it hasn't already been bound.
         * @param string $abstract
         * @param Closure|string|null $concrete
         * @param bool $singleton
         * @return void
         */
        public function bindIf(string $abstract, Closure|string|null $concrete = null, bool $singleton = false): void
        {
            if (!isset($this->bindings[$abstract])) {
                $this->bind($abstract, $concrete, $singleton);
            }
        }

        /**
         * Bind a singleton class to the container.
         * @param string $abstract
         * @param Closure|string|null $concrete
         * @return void
         */
        public function singleton(string $abstract, Closure|string|null $concrete = null): void
        {
            $this->bind($abstract, $concrete, true);
        }

        /**
         * Register an existing instance as a singleton in the container.
         * @param string $abstract
         * @param mixed $instance
         * @return void
         */
        public function instance(string $abstract, mixed $instance): void
        {
            $this->instances[$abstract] = $instance;
        }

        /**
         * Tag a set of services to be retrieved later.
         * @param array $services
         * @param string $tag
         * @return void
         */
        public function tag(array $services, string $tag): void
        {
            foreach ($services as $service) {
                $this->tags[$tag][] = $service;
            }
        }

        /**
         * Resolve all services for a given tag.
         * @param string $tag
         * @return array
         */
        public function tagged(string $tag): array
        {
            return array_map(fn($service) => $this->make($service), $this->tags[$tag] ?? []);
        }


        /**
         * Define a contextual binding.
         * @param string $concrete
         * @return ContextualBindingBuilder
         */
        public function when(string $concrete): ContextualBindingBuilder
        {
            return new ContextualBindingBuilder($this, $concrete);
        }

        /**
         * Resolve a class instance from the container.
         * @param string $abstract
         * @param array $parameters
         * @return mixed|object|string|null
         * @throws ReflectionException
         */
        public function make(string $abstract, array $parameters = []): mixed
        {
            if (isset($this->contextualBindings[$abstract])) {
                return $this->resolve($this->contextualBindings[$abstract], $parameters);
            }

            if (isset($this->instances[$abstract])) {
                return $this->instances[$abstract];
            }

            if (!isset($this->bindings[$abstract])) {
                return $this->resolve($abstract, $parameters);
            }

            $binding = $this->bindings[$abstract];
            $concrete = $binding['concrete'] ?? $abstract;

            $object = $concrete instanceof Closure ? $concrete($this, ...$parameters) : $this->resolve($concrete, $parameters);

            if ($binding['singleton']) {
                $this->instances[$abstract] = $object;
            }

            return $object;
        }

        /**
         * Resolve a class instance from the container.
         * @param string $concrete
         * @param array $parameters
         * @return mixed|object|string|null
         * @throws ReflectionException
         * @throws Exception
         */
        protected function resolve(string $concrete, array $parameters = []): mixed
        {
            if (!class_exists($concrete)) {
                throw new Exception("Cannot resolve [$concrete]: Class does not exist.");
            }

            $reflection = new ReflectionClass($concrete);
            $constructor = $reflection->getConstructor();

            if (!$constructor) {
                return new $concrete();
            }

            $dependencies = array_map(fn(ReflectionParameter $param) => $this->resolveParameter($param, $parameters), $constructor->getParameters());

            return $reflection->newInstanceArgs($dependencies);
        }

        /**
         * Resolve a single dependency.
         * @param ReflectionParameter $param
         * @param array $parameters
         * @return mixed|object|string|null
         * @throws ReflectionException
         */
        protected function resolveParameter(ReflectionParameter $param, array $parameters): mixed
        {
            $name = $param->getName();
            $type = $param->getType();

            if (array_key_exists($name, $parameters)) {
                return $parameters[$name];
            }

            if ($type && !$type->isBuiltin()) {
                return $this->make($type->getName());
            }

            if ($param->isDefaultValueAvailable()) {
                return $param->getDefaultValue();
            }

            throw new Exception("Cannot resolve parameter [$name]");
        }

        /**
         * Call a method from a class instance.
         * @param callable|string $callback
         * @param array $parameters
         * @return mixed
         * @throws ReflectionException
         */
        public function call(callable|string $callback, array $parameters = []): mixed
        {
            if (is_string($callback) && str_contains($callback, '@')) {
                [$class, $method] = explode('@', $callback);
                $callback = [$this->make($class), $method];
            }

            $reflection = new ReflectionMethod($callback[0], $callback[1]);
            $dependencies = array_map(fn(ReflectionParameter $param) => $this->resolveParameter($param, $parameters), $reflection->getParameters());

            return call_user_func_array($callback, $dependencies);
        }

        /**
         * Get the instance of the container.
         * @return Container
         */
        public static function getInstance(): Container
        {
            static $instance = null;
            if ($instance === null) {
                $instance = new static();
            }
            return $instance;
        }
    }
