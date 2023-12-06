<?php
declare(strict_types=1);

namespace Framework\Twig;


use Framework\Routing\Router;
use Pagerfanta\Pagerfanta;
use Pagerfanta\View\TwitterBootstrap4View;
use Pagerfanta\View\TwitterBootstrapView;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

/**
 * Created by PhpStorm at 05.12.2023
 *
 * @PagerFantaExtension
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Framework\Twig
 */
class PagerFantaExtension extends AbstractExtension
{


      protected Router $router;

      public function __construct(Router $router)
      {
          $this->router = $router;
      }


      public function getFunctions()
      {
          return [
              new TwigFunction('paginate', [$this, 'paginate'], ['is_safe' => ['html']])
          ];
      }


      /**
       * Genere la pagination
       *
       *  @param Pagerfanta $paginatedResults
       * @param string $route
       * @param array $routerParams
       * @param array $queryArgs
       * @return string
      */
      public function paginate(Pagerfanta $paginatedResults, string $route, array $routerParams = [], array $queryArgs = []): string
      {
          $view = new TwitterBootstrap4View();

          return $view->render($paginatedResults, function (int $page) use ($route, $routerParams, $queryArgs) {
               if ($page > 1) {
                   $queryArgs['p'] = $page;
               }
               return $this->router->generateUri($route, $routerParams, $queryArgs);
          });
      }
}