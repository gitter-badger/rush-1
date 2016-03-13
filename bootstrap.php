<?php

require_once __DIR__.'/vendor/autoload.php';

use Rush\Config;
use Rush\View;
use Illuminate\Database\Capsule\Manager;
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;

$eloquent = new Manager;
foreach (Config::load('database.php')->all() as $name => $connection) {
    if (isset($connection['uri'])) {
        $connection = array_merge($connection, Rush\parseDatabaseUri($connection['uri']));
        unset($connection['uri']);
    }

    $eloquent->addConnection($connection, $name);
}
$eloquent->setEventDispatcher(new Dispatcher(new Container));
$eloquent->setAsGlobal();
$eloquent->bootEloquent();

View::configure(Config::load('view.php')->all());
