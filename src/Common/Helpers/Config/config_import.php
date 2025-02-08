<?php

    use Common\Helpers\Exceptions\ConfigFileNotFound;
    use Common\Helpers\Exceptions\ConfigKeyNotExisted;

    /**
     * @throws ConfigKeyNotExisted
     * @throws ConfigFileNotFound
     */
    function config(string $key, bool $throwErrorIfNotExisted = false): string | null{
        $config = require_once base_path() . "App/Config/index.php";

        if(!is_array($config)){
            if($throwErrorIfNotExisted){
                throw new ConfigFileNotFound($key);
            }else{
                return null;
            }
        }
        if(array_key_exists($key, $config)){
            return $config[$key];
        }else{
            if($throwErrorIfNotExisted){
                throw new ConfigKeyNotExisted($key);
            }
            return null;
        }
    }
