<?php
declare(strict_types=1);

namespace Framework\Templating\Renderer;


use Psr\Container\ContainerInterface;

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
           return new TwigRenderer($container->get('views.path'));
       }
}