<?php

use App\Auth\Middleware\ForbiddenMiddleware;
use App\Auth\Security\DatabaseAuth;
use Framework\Security\Auth;

return [
  'auth.login' => '/login', // authentication path
  Auth::class  => \DI\get(DatabaseAuth::class),
  ForbiddenMiddleware::class => \DI\object()->constructorParameter('loginPath', \DI\get('auth.login'))
];