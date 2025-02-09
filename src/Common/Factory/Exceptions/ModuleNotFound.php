<?php

    namespace Common\Factory\Exceptions;

    use Exception;

    class ModuleNotFound extends Exception
    {
        public function __construct($module)
        {
            parent::__construct("Module $module not found");
        }
    }
