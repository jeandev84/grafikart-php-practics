<?php

use App\Http\Controller\Shopping\CartController;
use App\Http\Controller\Shopping\HomeController;
use Grafikart\Routing\Router;

return function(Router $router) {

    # Load routes via attributes
    $router->registerControllers([
        \App\Http\Controller\Attributes\HelloController::class,
        \App\Http\Controller\Attributes\Api\BooksController::class
    ]);



    # Home page
    $router->get('/', [HomeController::class, 'index'], 'home');
    $router->get('/cart', [CartController::class, 'index'], 'cart.list');
    $router->get('/cart/add/{id}', [CartController::class, 'add'], 'cart.add')
           ->where('id', '\d+'); // id is product id
    $router->get('/cart/delete/{id}', [CartController::class, 'delete'], 'cart.delete')
           ->where('id', '\d+'); // id is product id
    $router->post('/cart/recalculate', [CartController::class, 'recalculate'], 'cart.recalculate');
    return $router;
};
