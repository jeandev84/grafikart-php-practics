<?php
declare(strict_types=1);

namespace Grafikart\Routing;


use AltoRouter;
use Grafikart\Http\Response\Response;
use Grafikart\Security\Exception\ForbiddenException;
use Grafikart\Templating\Renderer;

/**
 * Created by PhpStorm at 27.11.2023
 *
 * @Router
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Grafikart\Routing
 */
class Router
{

     /**
      * @var string
     */
     protected string $viewPath;


     /**
      * @var AltoRouter
     */
     protected AltoRouter $router;



     # public ?string $layout = "layouts/index";


     public function __construct()
     {
         $this->router   = new AltoRouter();
     }


     /**
      * @param string $url
      * @param $action
      * @param string|null $name
      * @return $this
      * @throws \Exception
     */
     public function get(string $url, $action, ?string $name = null): self
     {
         $this->router->map('GET', $url, $action, $name);

         return $this;
     }




    /**
     * @param string $url
     * @param $action
     * @param string|null $name
     * @return $this
     * @throws \Exception
     */
     public function post(string $url, $action, ?string $name = null): self
     {
         $this->router->map('POST', $url, $action, $name);

         return $this;
     }




    /**
     * @param string $url
     * @param $action
     * @param string|null $name
     * @return $this
     * @throws \Exception
     */
    public function put(string $url, $action, ?string $name = null): self
    {
        $this->router->map('PUT', $url, $action, $name);

        return $this;
    }




    /**
     * @param string $url
     * @param $action
     * @param string|null $name
     * @return $this
     * @throws \Exception
     */
    public function delete(string $url, $action, ?string $name = null): self
    {
        $this->router->map('DELETE', $url, $action, $name);

        return $this;
    }





    /**
     * @param string $method
     * @param string $url
     * @param $action
     * @param string|null $name
     * @return $this
     * @throws \Exception
     */
    public function map(string $method, string $url, $action, ?string $name = null): self
    {
        $this->router->map($method, $url, $action, $name);

        return $this;
    }


    /**
     * @param string $name
     * @param array $params
     * @return string
     * @throws \Exception
     */
     public function url(string $name, array $params = []): string
     {
         return $this->router->generate($name, $params);
     }


    /**
     * @return array|false
     */
     public function match(): array|false
     {
         return $this->router->match();
     }



     public function run(): self
     {
         /*
         $match = $this->router->match();
         $renderer = new Renderer($this->viewPath);
         $renderer->layout("layouts/default.php");
         $content  = $renderer->render($match['target']. ".php", [
             'router' => $this,
             'params' => $match['params']
         ]);

         $response = new Response($content);
         $response->sendBody();
         */

         $match  = $this->router->match();
         $view   = 'errors/404';
         $params = [];

         if ($match) {
             $view   = $match['target'];
             $params = $match['params'];
         }

         $router = $this;
         $isAdmin = strpos($view, 'admin/') !== false;
         $layout  = $isAdmin ? '/admin/layouts/default' : 'layouts/default';

         try {
             ob_start();
             require $this->viewPath . DIRECTORY_SEPARATOR. $view . '.php';
             $content = ob_get_clean();
             /* require $this->viewPath . DIRECTORY_SEPARATOR . $this->layout . '.php'; */
             require $this->viewPath . DIRECTORY_SEPARATOR . $layout . '.php';
         } catch (ForbiddenException $exception) {
               header("Location: ". $this->url("login") . '?forbidden=1');
               exit;
         }

         return $this;
     }
}