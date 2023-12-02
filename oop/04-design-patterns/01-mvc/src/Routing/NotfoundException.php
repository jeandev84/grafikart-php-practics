<?php
declare(strict_types=1);

namespace Grafikart\Routing;


/**
 * Created by PhpStorm at 01.12.2023
 *
 * @NotfoundException
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Grafikart\Routing
 */
class NotfoundException extends \Exception
{

     /**
      * @param string $path
     */
     public function __construct(string $path)
     {
         parent::__construct("Route $path not found", 404);
     }
}