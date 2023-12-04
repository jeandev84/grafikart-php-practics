<?php
declare(strict_types=1);

namespace Grafikart;


use Grafikart\Container\Container;
use Grafikart\Http\Response\RedirectResponse;
use Grafikart\Http\Response\Response;
use Grafikart\Routing\Route;
use Grafikart\Routing\Router;

/**
 * Created by PhpStorm at 30.11.2023
 *
 * @AbstractController
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Grafikart
 */
abstract class AbstractController
{

      protected Container $container;
      protected Router $router;
      protected string $layout = 'layouts/default';


      public function __construct(Container $container)
      {
          $this->container = $container;
          $this->router    = $container['router'];
      }


      /**
       * @param string $template
       * @param array $data
       * @return Response
      */
      public function render(string $template, array $data = []): Response
      {
          $view    = $this->container['view'];
          $view->layout($this->layout);
          $data = array_merge(['router' => $this->container['router']], $data);
          $content = $view->render($template, $data);
          return new Response($content);
      }



      public function redirectToRoute(string $name, array $params = []): RedirectResponse
      {
          return new RedirectResponse($this->generateRoute($name, $params), 301);
      }


      public function generateRoute(string $name, array $params = []): string
      {
          return $this->router->url($name, $params);
      }



      protected function getConnection(): Database\Connection\PdoConnection
      {
          return \App\Helpers\Connection::make();
      }
}