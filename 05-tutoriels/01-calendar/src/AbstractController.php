<?php
declare(strict_types=1);

namespace App;

use App\Http\Response;

/**
 * AbstractController
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  App
 */
class AbstractController
{

      /**
       * @var App
      */
      protected App $app;



      /**
       * @param App $app
      */
      public function __construct(App $app)
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
           return  new Response($this->app['view']->render($template, $data));
      }
}