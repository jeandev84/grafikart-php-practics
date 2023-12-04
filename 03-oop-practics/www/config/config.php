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
    RendererInterface::class => \DI\factory(TwigRendererFactory::class)
];