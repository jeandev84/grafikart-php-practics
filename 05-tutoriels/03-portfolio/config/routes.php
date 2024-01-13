<?php

use Grafikart\Http\Response\Response;
use Grafikart\Routing\Router;

return function(Router $router) {

    $router->get('/', function () {
        return new Response("Welcome");
    });

    return $router;
};
