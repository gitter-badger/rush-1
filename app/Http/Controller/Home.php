<?php

namespace Rush\Http\Controller;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Rush\View;

class Home
{
    public function index(RequestInterface $req, ResponseInterface $res)
    {
        $view = new View('home/index');
        $html = $view->render(['name' => $req->getAttribute('name', 'rush')]);

        return new HtmlResponse($html);
    }
}
