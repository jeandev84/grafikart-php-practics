<?php

use Grafikart\{Container, Database\Connection, Database\Model};

require __DIR__.'/vendor/autoload.php';

$container = new Container();

/*
$container->bind(Connection::class, function () {
    return  new Connection('root', 'root', 'blog');
});
dump($container->get(Connection::class));
dump($container->get(Connection::class));
dump($container->get(Connection::class));
dump($container->get(Connection::class));

$container->bind(Model::class, function () use ($container) {
    return new Model($container->get(Connection::class));
});

$container->factory(Model::class, function () use ($container) {
    return new Model($container->get(Connection::class));
});

dump($container->get(Model::class));
dump($container->get(Model::class));
dump($container->get(Model::class));


$connection = new Connection('root', 'root', 'blog');;
$container->instance($connection);
*/


$container->bind(Connection::class, function () {
    return  new Connection('root', 'root', 'blog');
});


dump($container->get(Model::class));
dump($container->get(Model::class));
dump($container->get(Model::class));


