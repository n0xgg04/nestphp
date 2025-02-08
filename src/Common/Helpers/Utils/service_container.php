<?php

    use Common\Core\Container;

    function container(string $container): Container{
        return Container::getInstance();
    }
