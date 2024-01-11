<?php

use App\Controller\HomeController;

require '../vendor/autoload.php';
require '../src/helpers.php';

$app = \App\App::instance();

$app->bind('basePath', realpath(__DIR__.'/../'));

$app->bind('connection', function () {
    return \App\Database\Connection\ConnectionFactory::make();
});

$app->bind('router', function () {
    $router = new \App\Routing\Router();
    $router->get('/', [HomeController::class, 'index']);
    $router->get('/event', [\App\Controller\EventController::class, '']);
    return $router;
});

$app->bind('view', function (\App\App $app) {
    return new \App\Templating\Renderer($app->get('basePath') . '/views');
});

return $app;
