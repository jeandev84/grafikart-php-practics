<?php

use Grafikart\{
    Container,
    Connection,
    Model
};

require __DIR__.'/vendor/autoload.php';

$container = new Container();
$container->set(Connection::class, function () {
    return  new Connection('root', 'root', 'blog');
});

$container->set(Model::class, function () use ($container) {
    return new Model($container->get(Connection::class));
});


dump($container->get(Connection::class));
dump($container->get(Connection::class));
dump($container->get(Connection::class));
dump($container->get(Connection::class));
