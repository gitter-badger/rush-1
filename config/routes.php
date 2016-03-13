<?php

use Rush\Route;
use Rush\Model\User;
use Zend\Diactoros\Response\RedirectResponse;

Route::get('/', function ($request, $response) {
    // https://github.com/zendframework/zend-diactoros/blob/master/doc/book/custom-responses.md
    return new RedirectResponse('/welcome/rush', 301);
});
Route::get('/welcome/{name}', '\\Rush\\Http\\Controller\\Home#index');
