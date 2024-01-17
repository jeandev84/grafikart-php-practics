<?php

use App\Http\Controller\Shopping\CartController;
use App\Http\Controller\Shopping\HomeController;
use Grafikart\Routing\Router;

return function(Router $router) {

    # Home page
    $router->get('/', [HomeController::class, 'index'], 'home');
    $router->get('/cart', [CartController::class, 'index'], 'cart.list');
    $router->get('/cart/add/{id}', [CartController::class, 'add'], 'cart.add')
           ->where('id', '\d+'); // id is product id
    $router->get('/cart/delete/{id}', [CartController::class, 'delete'], 'cart.delete')
           ->where('id', '\d+'); // id is product id

    return $router;
};
