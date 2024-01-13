<?php

use App\Http\Controller\HomeController;
use Grafikart\Http\Response\Response;
use Grafikart\Routing\Router;

return function(Router $router) {

    $router->get('/', [HomeController::class, 'index']);

    return $router;
};
