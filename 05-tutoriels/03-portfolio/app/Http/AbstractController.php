<?php
declare(strict_types=1);

namespace App\Http;

use Grafikart\Container\Container;
use Grafikart\Database\Connection\PdoConnection;
use Grafikart\HTML\Form\Form;
use Grafikart\Http\Response\RedirectResponse;
use Grafikart\Http\Response\Response;
use Grafikart\Http\Session\SessionInterface;
use Grafikart\Routing\Router;
use Grafikart\Security\Auth;
use Grafikart\Security\Token\Csrf\CsrfTokenInterface;
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
       * @var Auth
      */
      protected Auth $auth;


      /**
       * @var SessionInterface
      */
      protected SessionInterface $session;



      /**
       * @var CsrfTokenInterface|mixed
      */
      protected CsrfTokenInterface $csrfToken;




      /**
       * @var Router
      */
      protected Router $router;




      /**
       * @var string
      */
      protected string $layout = 'layouts/default';



      /**
       * @var string
      */
      protected string $extension = 'phtml';




      /**
       * @param Container $app
      */
      public function __construct(Container $app)
      {
          $this->app       = $app;
          $this->auth      = $app['auth'];
          $this->session   = $app[SessionInterface::class];
          $this->csrfToken = $app[CsrfTokenInterface::class];
          $this->router    = $app[Router::class];
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
          $view = $this->app[Renderer::class];
          $view->layout($this->layout);
          $view->extension($this->extension);
          return $view->render($template, $data);
      }




      /**
       * @param string $path
       * @return RedirectResponse
      */
      public function redirectTo(string $path): RedirectResponse
      {
          return new RedirectResponse($path);
      }





      /**
       * @param string $name
       * @param array $params
       * @return string
      */
      public function generatePath(string $name, array $params = []): string
      {
          return $this->router->generate($name, $params);
      }




      /**
       * @param string $name
       * @param array $params
       * @return RedirectResponse
      */
      public function redirectToRoute(string $name, array $params = []): RedirectResponse
      {
          return $this->redirectTo($this->generatePath($name, $params));
      }






      /**
       * @param string $key
       * @param string $message
       * @return $this
      */
      public function addFlash(string $key, string $message): static
      {
          $this->session->addFlash($key, $message);

          return $this;
      }


      /**
       * @return CsrfTokenInterface
      */
      public function getCsrfToken(): CsrfTokenInterface
      {
          return $this->csrfToken;
      }




      /**
       * @return PdoConnection
      */
      public function getConnection(): PdoConnection
      {
          return $this->app[PdoConnection::class];
      }


      /**
       * @param string $class
       * @param array $data
       * @param array $options
       * @return Form
      */
      public function createForm(string $class, array $data = [], array $options = []): Form
      {
            $form  = new Form($data);
            $class = new $class($this->app);
            $class->buildForm($form);
            return $form;
      }
}