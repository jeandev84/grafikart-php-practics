<?php

use App\Http\Controller\CalendarController;
use App\Http\Controller\DateController;
use Grafikart\Routing\Router;

return function(Router $router) {

    # Home page
    $router->get('/', [CalendarController::class, 'index'], 'home');
    $router->get('/date', [DateController::class, 'index'], 'date');

    return $router;
};
