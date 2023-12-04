<?php

use Framework\Routing\Router;
use Framework\Templating\Renderer\RendererInterface;
use Framework\Templating\Renderer\TwigRendererFactory;

return [
    'views.path' => dirname(__DIR__). '/views',
    Router::class => \DI\object(),
    RendererInterface::class => \DI\factory(TwigRendererFactory::class)
];