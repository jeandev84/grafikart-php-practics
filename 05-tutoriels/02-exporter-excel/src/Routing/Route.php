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
}