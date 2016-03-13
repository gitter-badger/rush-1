<?php

namespace Rush;

use \FastRoute\RouteCollector;

class Route
{
    const DELIMITER = '#';

    private static $route;

    public static function set(RouteCollector $r)
    {
        self::$route = $r;
    }

    public static function __callStatic($http_method, array $args = [])
    {
        list($path, $handler) = $args;

        if (is_string($handler)) {
            list($class, $method) = explode(self::DELIMITER, $handler);
            $handler = [new $class, $method];
        }

        self::$route->addRoute(strtoupper($http_method), $path, $handler);
    }
}
