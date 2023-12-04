<?php
use Framework\Templating\Renderer\RendererInterface;
use Framework\Templating\Renderer\TwigRendererFactory;

return [
   'views.path' => dirname(__DIR__). '/views',
   RendererInterface::class => \DI\factory(TwigRendererFactory::class)
];