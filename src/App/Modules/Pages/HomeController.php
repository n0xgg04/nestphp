<?php

namespace App\Modules\Pages;

use Common\Helpers\Exceptions\ConfigFileNotFound;
use Common\Helpers\Exceptions\ConfigFileNotValid;
use Common\Http\Annotations\Body;
use Common\Routing\Annotations\Controller;
use Common\Routing\Annotations\Methods\{Get, Post};

#[Controller("home")]
readonly class HomeController
{
    public function __construct() {}

    #[Post("/")]
    public function landingPage(#[Body] HomeDTO $body)
    {
       // return $this->homeService->getHomeMessage();
    }

    /**
     * @throws ConfigFileNotValid
     * @throws ConfigFileNotFound
     */
    #[Get("/test")]
    public function testPage(): mixed
    {
        return view(path: "home");
    }
}
