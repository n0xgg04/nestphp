<?php

use Common\Helpers\Exceptions\ConfigFileNotFound;
use Common\Helpers\Exceptions\ConfigKeyNotExisted;


/**
 * Retrieve a configuration value by key.
 *
 * @param string $key The configuration key to retrieve.
 * @param bool $throwErrorIfNotExisted Whether to throw an error if the key does not exist.
 * @return string|null The configuration value or null if not found.
 * @throws ConfigFileNotFound If the configuration file is not found.
 * @throws ConfigKeyNotExisted If the configuration key does not exist.
 */
function config(string $key, bool $throwErrorIfNotExisted = false): string|null
{
    $config = require_once base_path() . "App/Config/index.php";

    if (!is_array($config)) {
        if ($throwErrorIfNotExisted) {
            throw new ConfigFileNotFound($key);
        } else {
            return null;
        }
    }
    if (array_key_exists($key, $config)) {
        return $config[$key];
    } else {
        if ($throwErrorIfNotExisted) {
            throw new ConfigKeyNotExisted($key);
        }
        return null;
    }
}
