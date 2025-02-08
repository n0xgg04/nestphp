<?php

    namespace Common\Factory;

    use Common\Core\Container;
    use Common\Factory\Traits\ResolveModule;
    use Common\Helpers\Exceptions\ConfigFileNotFound;
    use Common\Helpers\Exceptions\ConfigKeyNotExisted;
    use Common\Http\Request;

    class AppFactory
    {
        use ResolveModule;

        private Container $serviceContainer;

        /**
         * @throws ConfigKeyNotExisted
         * @throws ConfigFileNotFound
         */
        public function __construct()
        {
            $this->serviceContainer = Container::getInstance();
            $this->serviceContainer->bindIf(Request::class, fn() => new Request());

            // Load root module
            $rootModuleClass = config("root_module");
            $this->resolveModule($rootModuleClass);
        }

        static public function handleRequest(): void
        {
            echo view("home");
        }
    }
