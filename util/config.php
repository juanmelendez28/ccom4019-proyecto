<?php
/**
 * Database configuration
 * 
 * Configuration file for the database connection.
 * 
 * Set up here the configuration credentials for the database connection.
 */
return [

    'database' => [
        'service' => 'mysql',
        'host' => '127.0.0.1',
        'port' => 3306,
        'dbname' => 'Electivas UPRA',
        'user' => 'root',
        'pass' => '', // change the password to your own (default is empty)
    ]
];