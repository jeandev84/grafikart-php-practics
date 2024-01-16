<?php

use App\Http\Controller\Admin\CategoryController;
use App\Http\Controller\Admin\DashboardController;
use App\Http\Controller\Admin\WorkController;
use App\Http\Controller\Admin\WorkImageController;
use App\Http\Controller\AuthController;
use App\Http\Controller\CalendarController;
use App\Http\Controller\PortfolioController;
use App\Http\Middlewares\CsrfTokenMiddleware;
use App\Http\Middlewares\GuestMiddleware;
use Grafikart\Routing\Router;

return function(Router $router) {

    # Home page
    $router->get('/', [CalendarController::class, 'index'], 'home');

    return $router;
};
