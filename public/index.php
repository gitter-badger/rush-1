<?php

require_once __DIR__.'/../bootstrap.php';

use Rush\Config;
use Relay\Runner;
use Zend\Diactoros\Response;
use Zend\Diactoros\ServerRequestFactory;

//Create a relay dispatcher and add some middlewares:
$run = new Runner(Config::load('middlewares.php')->all());
$res = $run(ServerRequestFactory::fromGlobals(), new Response());
Rush\Http\respond($res);
