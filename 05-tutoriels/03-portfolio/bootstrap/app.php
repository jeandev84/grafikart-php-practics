<?php

// bindings
use App\Http\Handlers\NotFoundHandler;
use Grafikart\Container\Container;
use Grafikart\Database\Connection\PdoConnection;
use Grafikart\Http\Handlers\QueueRequestHandler;
use Grafikart\Http\Handlers\RequestHandlerInterface;
use Grafikart\Routing\Router;
use Grafikart\Templating\Renderer;

define('BASE_PATH', dirname(__DIR__));

$config = require BASE_PATH . '/config/app.php';

$app = Container::instance();

$app->bind(RequestHandlerInterface::class, function () {
   return new QueueRequestHandler(new NotFoundHandler());
});

$app->bind(PdoConnection::class, function () use ($config) {
    return PdoConnection::make($config['database']);
});

$app->bind(Router::class, function () {
    $router = new Router();
    $routes = require BASE_PATH . '/config/routes.php';
    return $routes($router);
});

$app->bind(Renderer::class, function () {
    return new Renderer(BASE_PATH . '/views');
});

return $app;