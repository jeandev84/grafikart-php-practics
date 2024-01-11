<?php
namespace Framework\Routing\Dispatcher;


use Framework\Routing\Route\Route;

/**
 * @RouteDispatcherInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Framework\Routing\Dispatcher
*/
interface RouteDispatcherInterface
{

     /**
      * Dispatch route
      *
      * @param Route $route
      *
      * @return mixed
     */
     public function dispatchRoute(Route $route): mixed;
}