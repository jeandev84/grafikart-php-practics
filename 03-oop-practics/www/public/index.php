<?php

use App\Admin\AdminModule;
use App\Blog\BlogModule;
use Framework\Middleware\MethodMiddleware;
use Framework\Middleware\NotFoundMiddleware;
use Framework\Middleware\RouteDispatcherMiddleware;
use Framework\Middleware\RouterMiddleware;
use Framework\Middleware\TrailingSlashMiddleware;
use Framework\Templating\Renderer\RendererInterface;

require dirname(__DIR__).'/vendor/autoload.php';


$modules = [
    AdminModule::class,
    BlogModule::class,
];


$app = (new \Framework\App(dirname(__DIR__). '/config/config.php'))
       ->addModule(AdminModule::class)
       ->addModule(BlogModule::class)
       ->pipe(TrailingSlashMiddleware::class)
       ->pipe(MethodMiddleware::class)
       ->pipe(RouterMiddleware::class)
       ->pipe(RouteDispatcherMiddleware::class)
       ->pipe(NotFoundMiddleware::class)
;


if (php_sapi_name() !== "cli") {
    $response = $app->run(\GuzzleHttp\Psr7\ServerRequest::fromGlobals());
    \Http\Response\send($response);
}