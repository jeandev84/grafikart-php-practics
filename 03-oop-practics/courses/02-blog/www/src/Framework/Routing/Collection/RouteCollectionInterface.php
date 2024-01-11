<?php
namespace Framework\Routing\Collection;


use Framework\Routing\Route\Route;

/**
 * @RouteCollectionInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Framework\Routing\Collection
*/
interface RouteCollectionInterface
{

     /**
      * Returns all routes
      *
      * @return Route[]
     */
     public function getRoutes(): array;




    /**
     * Returns named route
     *
     * @param string $name
     *
     * @return Route|null
    */
    public function getRoute(string $name): ?Route;







    /**
     * Determine if named route exists
     *
     * @param string $name
     *
     * @return bool
    */
    public function hasRoute(string $name): bool;
}