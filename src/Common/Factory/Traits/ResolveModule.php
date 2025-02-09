<?php
    namespace Common\Factory\Traits;

    use Common\Factory\Exceptions\ModuleNotFound;
    use Common\Module\Annotations\Module;
    use ReflectionClass;
    use ReflectionException;

    trait ResolveModule
    {
        use ResolveController;
        /**
         * @throws ReflectionException
         * @throws ModuleNotFound
         */
        public function resolveModule($module): void
        {
            $reflectionClass = new ReflectionClass($module);

            $moduleAttributes = $reflectionClass->getAttributes(Module::class);

            if (empty($moduleAttributes)) {
                throw new ModuleNotFound("Module not found");
            }

            $moduleInstance = $moduleAttributes[0]->newInstance();

            $controllers = $moduleInstance->controller ?? [];
            $providers = $moduleInstance->providers ?? [];
            $import = $moduleInstance->import ?? [];
            $export = $moduleInstance->export ?? [];

            //! Resolve controller
            $this->resolveController($controllers);
        }
    }
