<?php

use Grafikart\Database\Connection\PdoConnection;

require 'vendor/autoload.php';

$connection = PdoConnection::make([
    'dsn' => 'mysql:host=127.0.0.1;dbname=grafikart_shopping_cart;charset=utf8',
    'username' => 'root',
    'password' => 'secret',
    'options' => [
        #PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'
    ],
]);


$repository   = new \App\Repository\ProductRepository($connection);


#dd($repository->findAll());

dd($repository->find(2));

