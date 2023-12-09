<?php
declare(strict_types=1);

namespace App\Framework\Middleware\Security;


use Framework\Security\Auth;
use Psr\Container\ContainerInterface;

/**
 * Created by PhpStorm at 09.12.2023
 *
 * @RoleMiddlewareFactory
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Framework\Middleware\Security
 */
class RoleMiddlewareFactory
{


      /**
       * @var Auth
      */
      protected Auth $auth;



      /**
       * @param Auth $auth
      */
      public function __construct(Auth $auth)
      {
          $this->auth = $auth;
      }


      /**
       * @param $role
       * @return RoleMiddleware
      */
      public function makeForRole($role): RoleMiddleware
      {
           return new RoleMiddleware($this->auth, $role);
      }
}