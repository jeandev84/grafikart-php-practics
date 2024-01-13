<?php

use App\Http\Controller\AuthController;
use App\Http\Controller\HomeController;
use App\Http\Middlewares\AuthenticatedMiddleware;
use Grafikart\Routing\Router;

return function(Router $router) {

    $router->get('/', [HomeController::class, 'index'], 'home')
           ->middleware(AuthenticatedMiddleware::class);

    $router->map('GET|POST', '/auth/login', [AuthController::class, 'login'], 'auth.login');

    return $router;
};
