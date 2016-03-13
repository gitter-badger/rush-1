<?php

return [
    'default' => [
        /**
         * Available values are `mysql`, `pgsql`, `sqlite`, `sqlsrv`
         */
        'driver' => 'sqlite',

        /**
         * @see Laravel document
         */
        'database' => __DIR__.'/../resouces/storage/development.sqlite',

        'prefix' => '',
    ],
];
