<?php
declare(strict_types=1);

namespace Tests\Framework\Modules;

use Framework\Routing\Router;


/**
 * Created by PhpStorm at 04.12.2023
 *
 * @ErroredModule
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Tests\Framework\Modules
 */
class ErroredModule
{
      public function __construct(Router $router)
      {
          $router->get('/demo', function () {
              return new \stdClass();
          }, 'demo');
      }
}