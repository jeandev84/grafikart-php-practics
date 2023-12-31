<?php

use Framework\Routing\Router;
use Framework\Templating\Renderer\RendererInterface;
use Framework\Templating\Renderer\TwigRendererFactory;
use Framework\Twig\RouterTwigExtension;

return [
    'views.path' => dirname(__DIR__). '/views',
    'twig.extensions' => [
        \DI\get(RouterTwigExtension::class)
    ],
    Router::class => \DI\object(),
    RendererInterface::class => \DI\factory(TwigRendererFactory::class)
];