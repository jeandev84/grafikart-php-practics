<?php
declare(strict_types=1);

namespace App\Routing;

/**
 * Router
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  App\Routing
 */
class Router
{

    /**
     * @var array
     */
    protected array $routes = [];




    /**
     * @param string $path
     * @param callable|array $callback
     * @return $this
     */
    public function get(string $path, callable|array $callback): static
    {
        $this->routes['GET'][$path] = $callback;

        return $this;
    }




    /**
     * @param string $path
     * @param callable|array $callback
     * @return $this
     */
    public function post(string $path, callable|array $callback): static
    {
        $this->routes['POST'][$path] = $callback;

        return $this;
    }


    /**
     * @return array
    */
    public function getRoutes(): array
    {
        return $this->routes;
    }
}