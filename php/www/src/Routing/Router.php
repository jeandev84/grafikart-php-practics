<?php
declare(strict_types=1);

namespace Grafikart\Routing;


use AltoRouter;
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


     public function __construct(string $viewPath)
     {
         $this->router   = new AltoRouter();
         $this->viewPath = $viewPath;
     }


     /**
      * @param string $url
      * @param string $view
      * @param string|null $name
      * @return $this
      * @throws \Exception
     */
     public function get(string $url, string $view, ?string $name = null): self
     {
         $this->router->map('GET', $url, $view, $name);

         return $this;
     }


    /**
     * @param string $url
     * @param string $view
     * @param string|null $name
     * @return $this
     * @throws \Exception
     */
     public function post(string $url, string $view, ?string $name = null): self
     {
         $this->router->map('POST', $url, $view, $name);

         return $this;
     }


     public function url(string $name, array $params = []): string
     {
         return $this->router->generate($name, $params);
     }


     public function run(): self
     {
         $match = $this->router->match();
         $view  = $match['target'];
         $renderer = new Renderer($this->viewPath);
         $renderer->layout("layouts/default.php");
         echo $renderer->render($view. ".php", ['router' => $this]);

         /*
         $router = $this;
         ob_start();
         require $this->viewPath . DIRECTORY_SEPARATOR. $view . '.php';
         $content = ob_get_clean();
         require $this->viewPath . DIRECTORY_SEPARATOR . 'layouts/default.php';
         */

         return $this;
     }
}