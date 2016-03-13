<?php

namespace Rush;

use \DI\ContainerBuilder;

class Container
{
    private static $container;

    public static function __callStatic($method, array $args = [])
    {
        if (is_null(self::$container)) {
            $builder = new ContainerBuilder();
            self::$container = $builder->build();
        }

        return call_user_func_array([self::$container, $method], $args);
    }
}
