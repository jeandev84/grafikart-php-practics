<?php

use App\Http\Controller\Admin\CategoryController;
use App\Http\Controller\Admin\DashboardController;
use App\Http\Controller\AuthController;
use App\Http\Controller\HomeController;
use App\Http\Middlewares\GuestMiddleware;
use Grafikart\Routing\Router;

return function(Router $router) {

    # Home page
    $router->get('/', [HomeController::class, 'index'], 'home')
           ->middleware(GuestMiddleware::class);

    # Authentication
    $router->map('GET|POST', '/login', [AuthController::class, 'login'], 'login');
    $router->map('GET|POST', '/logout', [AuthController::class, 'logout'], 'logout');


    # Admin
    $router->get('/admin', [DashboardController::class, 'index'], 'admin.dashboard');
    $router->get('/admin/category', [CategoryController::class, 'index'], 'admin.category');


    return $router;
};
