<?php
declare(strict_types=1);

namespace Grafikart;


use Grafikart\Container\Container;
use Grafikart\Database\Connection\PdoConnection;
use Grafikart\Http\RedirectResponse;
use Grafikart\Http\Response;
use Grafikart\Security\Auth;
use Grafikart\Security\UserInterface;
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
      * @var Auth
     */
     protected Auth $auth;


     /**
      * @var string
     */
     protected string $layout = 'layouts/default';




     /**
      * @param Container $app
     */
     public function __construct(Container $app)
     {
         $this->app  = $app;
         $this->auth = $app['auth'];
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


     public function redirect(string $path, int $status = 301): RedirectResponse
     {
          return new RedirectResponse($path, $status);
     }



     public function forbidden(): RedirectResponse
     {
         return $this->redirect('/login', 403);
     }




     /**
      * @return PdoConnection
     */
     public function getConnection(): PdoConnection
     {
          return $this->app['connection'];
     }



     public function auth(): Auth
     {
         return $this->auth;
     }




     /**
      * @return UserInterface|null
     */
     public function getUser(): ?UserInterface
     {
          return $this->auth->getUser();
     }
}