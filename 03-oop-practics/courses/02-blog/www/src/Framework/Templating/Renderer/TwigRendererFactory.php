<?php
declare(strict_types=1);

namespace Framework\Templating\Renderer;


use Psr\Container\ContainerInterface;
use Twig\Environment;
use Twig\Extension\DebugExtension;
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
           $twig     = new Environment($loader, ['debug' => true]);
           $twig->addExtension(new DebugExtension());

           if ($container->has('twig.extensions')) {
               foreach ($container->get('twig.extensions') as $extension) {
                   $twig->addExtension($extension);
               }
           }

           return new TwigRenderer($twig);
       }
}