<?php

// bindings
use App\Http\Controller\CsvController;
use Grafikart\Container\Container;
use Grafikart\Database\Connection\PdoConnection;
use Grafikart\Routing\Router;
use Grafikart\Templating\Renderer;

define('BASE_PATH', dirname(__DIR__));

$config = require BASE_PATH . '/config/app.php';

$app = Container::instance();

$app->bind(PdoConnection::class, function () use ($config) {
    return PdoConnection::make($config['database']);
});

$app->bind(Router::class, function () {
    $router = new Router();
    $router->get('/', [CsvController::class, 'index']);
    $router->get('/export/csv', [CsvController::class, 'export']);
    return $router;
});

$app->bind(Renderer::class, function () {
    return new Renderer(BASE_PATH . '/views');
});

return $app;