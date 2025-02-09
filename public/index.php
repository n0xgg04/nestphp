<?php
declare(strict_types=1);

use Common\Factory\AppFactory;

require_once __DIR__ . "/../vendor/autoload.php";

$app = new AppFactory();
$app->handleRequest();
