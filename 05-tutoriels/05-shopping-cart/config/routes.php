<?php

use App\Http\Controller\Shopping\CartController;
use App\Http\Controller\Shopping\ProductController;
use Grafikart\Routing\Router;

return function(Router $router) {

    # Home page
    $router->get('/', [ProductController::class, 'index'], 'home');
    $router->get('/cart', [CartController::class, 'index'], 'cart.list');

    return $router;
};
