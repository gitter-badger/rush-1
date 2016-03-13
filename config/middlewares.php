<?php

use Psr7Middlewares\Middleware;
use Rush\Route;

return [
    //(optional) this allows whoops to choose the best handler according with the expected format
    Middleware::formatNegotiator(),
    Middleware::Whoops(), //(optional) provide a custom whoops instance

    //Handle errors
    // Middleware::errorHandler('error_handler_function')->catchExceptions(true),

    //Parse the request payload
    Middleware::payload(),

    //Get the client ip
    Middleware::clientIp(),

    //Detects the user preferred language
    Middleware::languageNegotiator(['ja', 'en']),

    //Execute fast route
    Middleware::fastRoute(FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $r) {
        Route::set($r);
        include __DIR__.'/routes.php';
    })),
];
