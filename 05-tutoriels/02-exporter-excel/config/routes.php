<?php

use App\Http\Controller\CsvController;
use Grafikart\Routing\Router;

return function(Router $router) {

    $router->get('/', [CsvController::class, 'index']);
    $router->get('/export/csv', [CsvController::class, 'export']);

    return $router;
};
