<?php
    namespace Common\Helpers\Exceptions;

    use Exception;

    class ConfigFileNotValid extends Exception
    {
        public function __construct(
            public string $file
        ) {
            parent::__construct("Config {$file} not valid");
        }
    }
