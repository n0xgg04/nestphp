<?php

use Common\Helpers\Exceptions\ConfigFileNotFound;
use Common\Helpers\Exceptions\ConfigFileNotValid;

/**
 * @param string $path
 * @param array|null $data
 * @return string
 * @throws ConfigFileNotFound
 * @throws ConfigFileNotValid
 */
function view(string $path, ?array $data = null): string
{
    $viewConfigPath = join_paths(base_path(), "App/Config/view.php");
    if (!file_exists($viewConfigPath)) {
        throw new ConfigFileNotFound("view.php[File not found]");
    }
    $viewConfig = require join_paths(base_path(), "App/Config/view.php");
    if (!is_array($viewConfig)) {
        throw new ConfigFileNotFound("view.php");
    }
    if (array_key_exists("view_path", $viewConfig)) {
        $viewDir = join_paths(base_path(), $viewConfig["view_path"]);
        if (is_dir($viewDir)) {
            $viewFile = join_paths($viewDir, $path . ".view.php");
            if (file_exists($viewFile)) {
                return require_once $viewFile;
            }
            throw new ConfigFileNotValid(
                "view.php[view_path][viewFile=$viewFile][File Not Found]"
            );
        } else {
            throw new ConfigFileNotValid(
                "view.php[view_path][viewDir=$viewDir][View Dir not Existed]"
            );
        }
    } else {
        throw new ConfigFileNotFound(
            "view.php[view_path][View path key not found]"
        );
    }
}
