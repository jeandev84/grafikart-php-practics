<?php
declare(strict_types=1);

namespace Tests\Framework\Modules;

use Routing\Router;


/**
 * Created by PhpStorm at 04.12.2023
 *
 * @StringModule
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Tests\Framework\Modules
 */
class StringModule
{
      public function __construct(Router $router)
      {
          $router->get('/demo', function () {
              return 'DEMO';
          }, 'demo');
      }
}