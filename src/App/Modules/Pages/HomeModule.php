<?php
    namespace App\Modules\Pages;

    use Common\Module\Annotations\Module;

    #[Module(
        [
            "Controller" => [HomeController::class],
            "Provider" => []
        ]
    )]
    class HomeModule{}
