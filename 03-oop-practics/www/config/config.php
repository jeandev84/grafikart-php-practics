<?php

use Framework\Routing\Extension\RouterTwigExtension;
use Framework\Routing\Router;
use Framework\Templating\Renderer\RendererInterface;
use Framework\Templating\Renderer\TwigRendererFactory;

return [
    'database.host'     => 'localhost',
    'database.username' => 'root',
    'database.password' => 'secret',
    'database.name'     => 'monsupersite',
    'views.path'        => dirname(__DIR__). '/views',
    'twig.extensions'   => [
        \DI\get(RouterTwigExtension::class)
    ],
    Router::class => \DI\object(),
    RendererInterface::class => \DI\factory(TwigRendererFactory::class),
    PDO::class => function(\Psr\Container\ContainerInterface $container) {

       $host     = $container->get('database.host');
       $database = $container->get('database.name');
       $username = $container->get('database.username');
       $password = $container->get('database.password');
       $dsn  = sprintf('mysql:host=%s;dbname=%s;', $host, $database);

       return new PDO($dsn, $username, $password, [
           PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
           PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
       ]);
    }
];