<?php
    namespace Common\Module\Annotations;

    use Attribute;

    #[Attribute(Attribute::TARGET_CLASS)]
    class Module
    {
        public array $controller;
        public array $providers;
        public array $import;
        public array $export;

        public function __construct(
            array $controller = [],
            array $providers = [],
            array $import = [],
            array $export = []
        ) {
            $this->controller = $controller;
            $this->providers = $providers;
            $this->import = $import;
            $this->export = $export;
        }
    }
