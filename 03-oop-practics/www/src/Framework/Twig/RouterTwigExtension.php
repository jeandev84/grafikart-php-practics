<?php
declare(strict_types=1);

namespace Framework\Twig;


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
 * @package Framework\Twig
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
                 new TwigFunction('path', [$this, 'pathFor']),
                 new TwigFunction('is_subpath', [$this, 'isSubPath'])
             ];
         }




         /**
           * @param string $routeName
           * @param array $params
           * @return string
         */
         public function pathFor(string $routeName, array $params = []): string
         {
              return $this->router->generateUri($routeName, $params);
         }




         /**
          * @param string $routeName
          *
          * @return bool
         */
         public function isSubPath(string $routeName): bool
         {
             $uri         = $_SERVER['REQUEST_URI'] ?? '/';
             $expectedUri = $this->router->generateUri($routeName);

             return (stripos($uri, $expectedUri) !== false);
         }
}