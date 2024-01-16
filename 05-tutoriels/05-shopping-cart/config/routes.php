<?php

use App\Http\Controller\Shopping\CartController;
use App\Http\Controller\Shopping\HomeController;
use Grafikart\Routing\Router;

return function(Router $router) {

    # Home page
    $router->get('/', [HomeController::class, 'index'], 'shopping.home');
    $router->get('/cart', [CartController::class, 'index'], 'shopping.cart.list');
    $router->get('/cart/add/{id}', [CartController::class, 'add'], 'shopping.cart.add')
           ->where('id', '\d+'); // id is product id

    return $router;
};
