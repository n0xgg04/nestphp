<?php
    namespace Common\Http;

    use Common\Http\Traits\RequestResolver;

    class Request
    {
        use RequestResolver;
        public string $method;

        public function __construct()
        {
            $this->method = $this->getMethod();
        }


        public function input(){

        }


    }
