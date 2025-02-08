<?php

    namespace App\Modules\Pages;

    use Common\Routing\Annotations\Controller;
    use Common\Routing\Annotations\Methods\Get;

    #[Controller('home')]
    class HomeController
    {
        #[Get("/")]
        public function landingPage(): mixed
        {
            return view("a");
        }
    }
