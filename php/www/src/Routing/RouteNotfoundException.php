<?php
declare(strict_types=1);

namespace Grafikart\Routing;


/**
 * Created by PhpStorm at 30.11.2023
 *
 * @RouteNotfoundException
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Grafikart\Routing
 */
class RouteNotfoundException extends \Exception
{
      public function __construct(string $path)
      {
          parent::__construct("Route $path not found. ", 404);
      }
}