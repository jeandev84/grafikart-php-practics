<?php

use App\Auth\Extensions\AuthTwigExtension;
use App\Auth\Security\DatabaseAuth;
use App\Auth\Security\Middleware\ForbiddenMiddleware;
use Framework\Security\Auth;
use Framework\Security\User\UserInterface;

return [
  'auth.login' => '/login', // authentication path
  'twig.extensions' => \DI\add([
      \DI\get(AuthTwigExtension::class)
  ]),
  UserInterface::class => \DI\factory(function (Auth $auth) {
      return $auth->getUser();
  })->parameter('auth', \DI\get(Auth::class)),
  Auth::class  => \DI\get(DatabaseAuth::class),
  ForbiddenMiddleware::class => \DI\object()->constructorParameter('loginPath', \DI\get('auth.login'))
];