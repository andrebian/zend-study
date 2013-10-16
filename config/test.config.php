<?php

return array(
    'db' => array(
        'driver' => 'PDO_SQLite',
        'dsn' => 'mysql:dbname=zf2napratica_test;thost=localhost',
        'driver_options' => array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        )
    )

);