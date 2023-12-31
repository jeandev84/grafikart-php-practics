<?php
namespace Framework\Routing\Exception;

/**
 * @NotFoundRouteException
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Framework\Routing\Exception
*/
class NotFoundRouteException extends NotFoundException
{

      /**
       * @param string $path
      */
      public function __construct(string $path)
      {
           parent::__construct("Route $path not found.");
      }
}