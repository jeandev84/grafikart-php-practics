<?php

use App\Http\Controller\Admin\CategoryController;
use App\Http\Controller\Admin\DashboardController;
use App\Http\Controller\Admin\WorkController;
use App\Http\Controller\Admin\WorkImageController;
use App\Http\Controller\AuthController;
use App\Http\Controller\PortfolioController;
use App\Http\Middlewares\CsrfTokenMiddleware;
use App\Http\Middlewares\GuestMiddleware;
use Grafikart\Routing\Router;

return function(Router $router) {

    # Home page
    $router->get('/', [PortfolioController::class, 'index'], 'home');
           #->middleware(GuestMiddleware::class);

    $router->get('/portfolio/show/{id}', [PortfolioController::class, 'index'], 'portfolio.show')
           ->where('id', '\d+');
           #->middleware(GuestMiddleware::class);

    # Authentication
    $router->map('GET|POST', '/login', [AuthController::class, 'login'], 'login');
    $router->map('GET|POST', '/logout', [AuthController::class, 'logout'], 'logout');


    # Admin
    $router->get('/admin', [DashboardController::class, 'index'], 'admin.dashboard');

    # Categories
    $router->get('/admin/category', [CategoryController::class, 'index'], 'admin.category.list');
    $router->get('/admin/category/create', [CategoryController::class, 'create'], 'admin.category.create');
    $router->post('/admin/category/store', [CategoryController::class, 'store'], 'admin.category.store');
    $router->get( '/admin/category/{id}/edit', [CategoryController::class, 'edit'], 'admin.category.edit')
           ->where('id', '\d+');
    $router->put( '/admin/category/{id}', [CategoryController::class, 'update'], 'admin.category.update')
           ->where('id', '\d+');
    # $router->delete('/admin/category/delete/(?P<id>\d+)', [CategoryController::class, 'delete'], 'admin.category.delete')
    $router->delete('/admin/category/delete/{id}', [CategoryController::class, 'delete'], 'admin.category.delete')
           ->where('id', '\d+')
           ->middleware( CsrfTokenMiddleware::class);


    # Works
    $router->get('/admin/work', [WorkController::class, 'index'], 'admin.work.list');
    $router->get('/admin/work/create', [WorkController::class, 'create'], 'admin.work.create');
    $router->post('/admin/work/store', [WorkController::class, 'store'], 'admin.work.store');
    $router->get( '/admin/work/{id}/edit', [WorkController::class, 'edit'], 'admin.work.edit')
        ->where('id', '\d+');
    $router->put( '/admin/work/{id}', [WorkController::class, 'update'], 'admin.work.update')
        ->where('id', '\d+');
    # $router->delete('/admin/work/delete/(?P<id>\d+)', [WorkController::class, 'delete'], 'admin.work.delete')
    $router->delete('/admin/work/delete/{id}', [WorkController::class, 'delete'], 'admin.work.delete')
           ->where('id', '\d+')
           ->middleware( CsrfTokenMiddleware::class);

    # Works ImageService
    $router->get('/admin/work/image/delete/{id}/{work}/{csrf}', [WorkImageController::class, 'deleteImage'], 'admin.work.image.delete')
           ->where('id', '\d+')
           ->where('csrf', '\w+')
           ->where('work', '\d+')
           ->middleware( CsrfTokenMiddleware::class);
    $router->get('/admin/work/image/highlight/{id}/{work}/{csrf}', [WorkImageController::class, 'highlightImage'], 'admin.work.image.highlight')
           ->where('id', '\d+')
           ->where('csrf', '\w+')
           ->where('work', '\d+')
           ->middleware( CsrfTokenMiddleware::class);


    return $router;
};
