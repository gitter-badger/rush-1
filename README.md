# rush

Rush is [PSR-7](http://www.php-fig.org/psr/psr-7/) based framework.

## Getting started

```
composer create-project rush/rush MyRushProject
```

## Settings

### HTTP middleware
See `config/middlewares.php` and [oscarotero/psr7-middlewares](https://github.com/oscarotero/psr7-middlewares).

### Routing
See `config/routes.php` and `app/Route.php` and [nikic/fast-route](https://github.com/nikic/FastRoute)

### Database
See `config/database.php` and [illuminate/database](https://github.com/illuminate/database).

Available engines are `mysql`, `pgsql`, `sqlite` and `sqlsrv`.

### Template engine
See `config/view.php` and [rush/view-strategies](https://github.com/Leko/php-view-strategies).

Available engines are [Jade](https://github.com/everzet/jade.php), [Fenom](https://github.com/fenom-template/fenom), [Dwoo](https://github.com/dwoo-project/dwoo), [FOIL](https://github.com/FoilPHP/Foil), [Plate](http://platesphp.com/engine/folders/), [Twig](https://github.com/twigphp/Twig) and [Latte](https://github.com/nette/latte)

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
