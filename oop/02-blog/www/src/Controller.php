<?php
declare(strict_types=1);

namespace Grafikart;


use Grafikart\Container\Container;
use Grafikart\Database\Connection\PdoConnection;
use Grafikart\Http\Response;
use Grafikart\Templating\Template;

/**
 * Created by PhpStorm at 01.12.2023
 *
 * @Controller
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Grafikart
 */
abstract class Controller
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
      * @param string $path
      *
      * @param array $parameters
      *
      * @return Response
     */
     public function render(string $path, array $parameters = []): Response
     {
         $content = $this->app['view']->render(
             new Template($this->app['root'] ."/views/$path.php", $parameters),
             $parameters
         );

         return new Response($content);
     }




     /**
      * @return PdoConnection
     */
     public function getConnection(): PdoConnection
     {
          return $this->app['database'];
     }
}