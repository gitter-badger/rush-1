<?php

return [
    'default' => [
        /**
         * Available values are `mysql`, `?pg?`, `sqlite`, `sqlsvr`
         */
        'driver' => 'sqlite',

        /**
         * @see Laravel document
         */
        'database' => __DIR__.'/../resouces/storage/development.sqlite',

        'prefix' => '',
    ],
];
