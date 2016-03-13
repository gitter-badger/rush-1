# rush

[![Join the chat at https://gitter.im/Leko/rush](https://badges.gitter.im/Leko/rush.svg)](https://gitter.im/Leko/rush?utm_source=badge&utm_medium=badge&utm_campaign=pr-badge&utm_content=badge)

Rush is [PSR-7](http://www.php-fig.org/psr/psr-7/) based framework.

## Getting started

```
composer create-project rush/rush MyRushProject
```

## Settings

### HTTP middleware
See `config/middlewares.php` and [oscarotero/psr7-middlewares](https://github.com/oscarotero/psr7-middlewares).

```php
<?php

use Psr7Middlewares\Middleware;

return [
    //(optional) this allows whoops to choose the best handler according with the expected format
    Middleware::formatNegotiator(),
    Middleware::Whoops(), //(optional) provide a custom whoops instance

    //Handle errors
    // Middleware::errorHandler('error_handler_function')->catchExceptions(true),

    //Parse the request payload
    Middleware::payload(),
    
    // ...
];
```

### Routing
See `config/routes.php` and `app/Route.php` and [nikic/fast-route](https://github.com/nikic/FastRoute)

```php
<?php

use Rush\Route;
use Zend\Diactoros\Response\RedirectResponse;

Route::get('/', function ($request, $response) {
    // https://github.com/zendframework/zend-diactoros/blob/master/doc/book/custom-responses.md
    return new RedirectResponse('/welcome/rush', 301);
});
Route::get('/welcome/{name}', '\\Rush\\Http\\Controller\\Home#index');
```

### Database
See `config/database.php` and [illuminate/database](https://github.com/illuminate/database).

Available engines are `mysql`, `pgsql`, `sqlite` and `sqlsrv`.

```php
<?php

return [
    'default' => [
        'driver' => Rush\env('RUSH_DB_DRIVER', 'sqlite'),

        'uri' => Rush\env('RUSH_DB_URI',
            'file://'.__DIR__.'/../resouces/storage/development.sqlite'),
    ],
];
```

### Template engine
See `config/view.php` and [rush/view-strategies](https://github.com/Leko/php-view-strategies).

Available engines are [Jade](https://github.com/everzet/jade.php), [Fenom](https://github.com/fenom-template/fenom), [Dwoo](https://github.com/dwoo-project/dwoo), [FOIL](https://github.com/FoilPHP/Foil), [Plate](http://platesphp.com/engine/folders/), [Twig](https://github.com/twigphp/Twig) and [Latte](https://github.com/nette/latte)

```php
<?php

return [
    'base_path' => __DIR__.'/../resouces/views',

    'default_extension' => 'twig',

    'strategies' => [
        'twig' => '\\Rush\\Strategy\\Twig',
    ],
];
```

> See the following articles for more detail.  
> [昨今のPHPのテンプレートエンジンについて調べて共通インタフェースを作った](http://leko.jp/archives/840)

### Service provider
See `config/providers.php` and `app/Container.php` and [PHP-DI documentation](http://php-di.org/doc/php-definitions.html).

```php
<?php

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

return [
    // ...

    Psr\Log\LoggerInterface::class => DI\factory(function () {
        $logger = new Logger('mylog');

        $fileHandler = new StreamHandler('path/to/your.log', Logger::DEBUG);
        $fileHandler->setFormatter(new LineFormatter());
        $logger->pushHandler($fileHandler);

        return $logger;
    }),
];
```


## Contribute

Contributions are always welcome!

1. Fork this repository
1. Create topic branch(ex. `fix/hoge-foo-bar`)
1. Write your code
1. Create pull request to `master` branch
