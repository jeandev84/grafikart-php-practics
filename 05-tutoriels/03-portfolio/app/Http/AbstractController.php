<?php
declare(strict_types=1);

namespace App\Http;

use Grafikart\Container\Container;
use Grafikart\Database\Connection\PdoConnection;
use Grafikart\Http\Response\Response;
use Grafikart\Templating\Renderer;

/**
 * AbstractController
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  App\Http
 */
abstract class AbstractController
{

      /**
       * @var Container
      */
      protected Container $app;


      /**
       * @param Container $app
      */
      public function __construct(Container $app)
      {
          $this->app = $app;
      }




      /**
       * @param string $template
       * @param array $data
       * @return Response
      */
      public function render(string $template, array $data = []): Response
      {
           return new Response($this->renderView($template, $data));
      }




      /**
       * @param string $template
       * @param array $data
       * @return string
      */
      public function renderView(string $template, array $data): string
      {
          return $this->app[Renderer::class]->render($template, $data);
      }





      /**
       * @return PdoConnection
      */
      public function getConnection(): PdoConnection
      {
          return $this->app[PdoConnection::class];
      }
}