<?php

return array(
    'db' => array(
        'driver' => 'PDO_Mysql',
        'dsn' => 'mysql:dbname=zf2napratica_test;host:localhost',
        'driver_options' => array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        )
    )

);