<?php

namespace Common\Helpers\Exceptions;

use Exception;

class ConfigKeyNotExisted extends Exception
{
    public function __construct(public string $key)
    {
        parent::__construct("Config key {$key} not existed");
    }
}
