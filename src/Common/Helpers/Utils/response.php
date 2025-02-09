<?php
    namespace Common\Helpers\Utils;

    use Common\Http\Response;

    /**
     * @throws \ReflectionException
     */
    function response(): Response{
        return container()->make(Response::class);
    }
