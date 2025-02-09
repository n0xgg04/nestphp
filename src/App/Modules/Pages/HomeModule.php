<?php
namespace App\Modules\Pages;

use Common\Module\Annotations\Module;
use Common\Module\BaseModule;

#[Module(
    controller: [HomeController::class],
    providers: [HomeService::class]
)]
class HomeModule extends BaseModule{}
