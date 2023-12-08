<?php
use Framework\Templating\Renderer\RendererInterface;

return [
   'config.view_path' => dirname(__DIR__). '/views',
   RendererInterface::class => function (Psr\Container\ContainerInterface $container) {
       return new \Framework\Templating\Renderer\TwigRenderer($container->get('config.view_path'));
   }
];