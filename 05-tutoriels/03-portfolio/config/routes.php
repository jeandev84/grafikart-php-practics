<?php

use App\Http\Controller\Admin\CategoryController;
use App\Http\Controller\Admin\DashboardController;
use App\Http\Controller\AuthController;
use App\Http\Controller\HomeController;
use App\Http\Middlewares\CsrfTokenMiddleware;
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
    $router->map('GET|POST', '/admin/category/create', [CategoryController::class, 'create'], 'admin.category.create');
    $router->map('GET|POST', '/admin/category/edit', [CategoryController::class, 'edit'], 'admin.category.edit');
    # $router->delete('/admin/category/delete/(?P<id>\d+)', [CategoryController::class, 'delete'], 'admin.category.delete')
    $router->delete('/admin/category/delete/{id}', [CategoryController::class, 'delete'], 'admin.category.delete')
           ->where('id', '\d+')
           ->middleware( CsrfTokenMiddleware::class);

    return $router;
};
