<?php

namespace Common\Factory;

use Common\Core\Container;
use Common\Factory\Traits\ResolveModule;
use Common\Factory\Traits\ResolveRequest;
use Common\Helpers\Exceptions\ConfigFileNotFound;
use Common\Helpers\Exceptions\ConfigFileNotValid;
use Common\Helpers\Exceptions\ConfigKeyNotExisted;

class AppFactory
{
    use ResolveModule;
    use ResolveRequest;

    private Container $serviceContainer;

    /**
     * @throws ConfigKeyNotExisted
     * @throws ConfigFileNotFound
     */
    public function __construct()
    {
        $this->serviceContainer = Container::getInstance();
        $this->resolveIncomingRequest();
        // Load root module
        $rootModuleClass = config("root_module");
        $this->resolveModule($rootModuleClass);
    }

    /**
     * @throws ConfigFileNotValid
     * @throws ConfigFileNotFound
     */
    public function handleRequest(): void
    {
        $this->routing();
    }
}
