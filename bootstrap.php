<?php

require_once __DIR__.'/vendor/autoload.php';

use Rush\Config;
use Rush\View;
use Illuminate\Database\Capsule\Manager;
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;

foreach (Config::load('providers.php')->all() as $name => $provider) {
    Container::set($name, new $provider, true);
}

$eloquent = new Manager;
foreach (Config::load('database.php')->all() as $name => $connection) {
    $eloquent->addConnection($connection, $name);
}
$eloquent->setEventDispatcher(new Dispatcher(new Container));
$eloquent->setAsGlobal();
$eloquent->bootEloquent();

View::configure(Config::load('view.php')->all());
