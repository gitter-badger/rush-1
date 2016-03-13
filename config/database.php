<?php

return [
    'default' => [
        /**
         * Set database driver name
         *
         * Available values are `mysql`, `pgsql`, `sqlite`, `sqlsrv`
         */
        'driver' => Rush\env('RUSH_DB_DRIVER', 'sqlite'),

        /**
         * Set database uri
         *
         * @see https://mattstauffer.co/blog/laravel-on-heroku-using-a-mysql-database
         */
        'uri' => Rush\env('CLEARDB_DATABASE_URL',
            'file://'.__DIR__.'/../resouces/storage/development.sqlite'),
    ],
];
