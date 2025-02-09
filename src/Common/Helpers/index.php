<?php
require_once __DIR__ . "/Utils/file_manager.php";
$folders = glob(__DIR__ . "/*", GLOB_ONLYDIR);
foreach ($folders as $dir) {
    if (is_dir($dir)) {
        $files = glob($dir . "/*.php");
        foreach ($files as $file) {
            require_once $file;
        }
    }
}
