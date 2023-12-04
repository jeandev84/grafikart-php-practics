<?php
declare(strict_types=1);

namespace Framework\Routing\Extension;


use Framework\Routing\Router;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

/**
 * Created by PhpStorm at 04.12.2023
 *
 * @RouterTwigExtension
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Framework\Routing\Extension
 */
class RouterTwigExtension extends AbstractExtension
{


         protected Router $router;


         public function __construct(Router $router)
         {
             $this->router = $router;
         }


         public function getFunctions()
         {
             return [
                 new TwigFunction('path', [$this, 'pathFor'])
             ];
         }



         public function pathFor(string $path, array $params = []): string
         {
              return $this->router->generateUri($path, $params);
         }
}