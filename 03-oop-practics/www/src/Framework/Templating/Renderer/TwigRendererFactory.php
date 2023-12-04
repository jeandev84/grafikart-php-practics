<?php
declare(strict_types=1);

namespace Framework\Templating\Renderer;


use Framework\Routing\Extension\RouterTwigExtension;
use Psr\Container\ContainerInterface;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

/**
 * Created by PhpStorm at 04.12.2023
 *
 * @TwigRendererFactory
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Framework\Templating\Renderer
 */
class TwigRendererFactory
{
       public function __invoke(ContainerInterface $container): TwigRenderer
       {
           $viewPath = $container->get('views.path');
           $loader   = new FilesystemLoader($viewPath);
           $twig     = new Environment($loader);
           $twig->addExtension($container->get(RouterTwigExtension::class));

           return new TwigRenderer($loader, $twig);
       }
}