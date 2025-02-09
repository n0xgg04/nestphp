<?php
    namespace Common\Http;

    use Common\Helpers\Exceptions\ConfigFileNotFound;
    use Common\Helpers\Exceptions\ConfigFileNotValid;

    class Response
    {
        public function __construct()
        {
        }

        public function json(array $data, $statusCode = 200): void
        {
            header('Content-Type: application/json');
            http_response_code($statusCode);
            echo json_encode($data);
        }

        /**
         * @throws ConfigFileNotValid
         * @throws ConfigFileNotFound
         */
        public function view(string $view): void
        {
            echo view($view);
        }

        public function execute(mixed $fn): void
        {
            $result = $fn();
            if(is_array($result)){
                $this->json($result);
            }else{
                if(is_string($result)){
                    echo $result;
                }
            }
        }
    }
