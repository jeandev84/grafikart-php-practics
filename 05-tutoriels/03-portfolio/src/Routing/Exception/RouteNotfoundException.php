<?php
declare(strict_types=1);

namespace Grafikart\Routing\Exception;

/**
 * RouteNotfoundException
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Grafikart\Routing\Exception
 */
class RouteNotfoundException extends \Exception
{

       /**
        * @param string $path
       */
      public function __construct(string $path)
      {
          parent::__construct("Route {$path} not found.", 404);
      }
}