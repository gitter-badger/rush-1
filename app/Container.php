<?php

namespace Rush;

use DI\ContainerBuilder;
use Webmozart\PathUtil\Path;

class Container
{
    private static $container;

    public static function __callStatic($method, array $args = [])
    {
        if (is_null(self::$container)) {
            $definitions = Path::join(__DIR__, '../config/providers.php');
            $builder = new ContainerBuilder();
            $builder->addDefinitions($definitions);
            self::$container = $builder->build();
        }

        return call_user_func_array([self::$container, $method], $args);
    }
}
