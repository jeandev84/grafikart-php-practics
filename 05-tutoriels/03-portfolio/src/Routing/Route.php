<?php
declare(strict_types=1);

namespace Grafikart\Routing;

/**
 * Route
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Grafikart\Routing
 */
class Route
{

      /**
       * @var array
      */
      protected array $matches = [];



      /**
       * @var array
      */
      protected array $middlewares = [];



      /**
       * @var array
      */
      protected array $wheres = [];



      /**
       * @var array
      */
      protected array $patterns = [];



      /**
       * @var array
      */
      protected array $replaces = [];



      /**
       * @param array $methods
       * @param string $path
       * @param mixed $action
       * @param string $name
      */
      public function __construct(
          protected array $methods,
          protected string $path,
          protected mixed  $action,
          protected string $name = ''
      )
      {
      }


     /**
      * @return array
     */
     public function getMethods(): array
     {
         return $this->methods;
     }



    /**
     * @return string
    */
    public function getPath(): string
    {
        return $this->path;
    }




    /**
     * @return mixed
    */
    public function getAction(): mixed
    {
        return $this->action;
    }


    /**
     * @return string
    */
    public function getName(): string
    {
        return $this->name;
    }


    /**
     * @return array
    */
    public function getMiddlewares(): array
    {
        return $this->middlewares;
    }



    /**
     * @param string $method
     * @return bool
    */
    public function matchMethod(string $method):  bool
    {
        return in_array($method, $this->methods);
    }




    /**
     * @param string $path
     * @return bool
    */
    public function matchPath(string $path): bool
    {
        if (! preg_match("#^$this->path$#i", $path, $matches)) {
            return false;
        }

        $this->matches = [];

        return true;
    }





    /**
     * @param string $method
     * @param string $path
     * @return bool
    */
    public function match(string $method, string $path): bool
    {
        return $this->matchMethod($method) && $this->matchPath($path);
    }




    /**
     * @param string $name
     * @param string $regex
     * @return $this
    */
    public function where(string $name, string $regex): static
    {
        $patterns   = ["#{{$name}}#", "#{{$name}}.?#"];
        $replaces   = ["(?P<$name>$regex)", "?(?P<$name>$regex)?"];

        $this->path = preg_replace($patterns, $replaces, $this->path);

        $this->wheres[$name] = $regex;
        $this->patterns[$name] = $patterns;
        $this->replaces[$name] = $replaces;

        return $this;
    }




    /**
     * @param array $middlewares
     *
     * @return $this
    */
    public function middlewares(array $middlewares): static
    {
         foreach ($middlewares as $middleware) {
             $this->middleware($middleware);
         }

         return $this;
    }




    /**
     * @param string $middleware
     * @return $this
    */
    public function middleware(string $middleware): static
    {
         $this->middlewares[] = $middleware;

         return $this;
    }


    /**
     * @param array $params
     * @return string
    */
    public function generate(array $params): string
    {
         return $this->path;
    }
}