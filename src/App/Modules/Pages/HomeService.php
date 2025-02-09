<?php
namespace App\Modules\Pages;

use Common\Core\IOC\Injectable;

#[Injectable]
readonly class HomeService
{
    public function __construct() {}

    public function getHomeMessage(): string
    {
        return "Hello World";
    }
}
