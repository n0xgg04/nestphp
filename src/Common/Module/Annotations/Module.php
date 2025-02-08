<?php

        namespace Common\Module\Annotations;

        use Attribute;

        #[Attribute(Attribute::TARGET_METHOD | Attribute::TARGET_CLASS)]
        class Module
        {
            /**
             * @param array $config
             */
            public function __construct(
                public array $config
            ) {}
        }
