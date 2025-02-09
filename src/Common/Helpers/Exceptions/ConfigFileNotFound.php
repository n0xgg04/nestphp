<?php
namespace Common\Helpers\Exceptions;

use Exception;

/**
 * Exception thrown when a configuration file is not found.
 */
class ConfigFileNotFound extends Exception
{
    /**
     * Constructor for ConfigFileNotFound.
     *
     * @param string $path The path to the configuration file that was not found.
     */
    public function __construct(public string $path)
    {
        parent::__construct("Config file {$path} not found");
    }
}
