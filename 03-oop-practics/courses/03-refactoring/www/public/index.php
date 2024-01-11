<?php

use App\Admin\AdminModule;
use App\Blog\BlogModule;
use GuzzleHttp\Psr7\ServerRequest;
use Middlewares\Whoops;
use Framework\Middleware\{CsrfMiddleware,
    TrailingSlashMiddleware,
    MethodMiddleware,
    RouterMiddleware,
    RouteDispatcherMiddleware,
    NotFoundMiddleware};


chdir(dirname(__DIR__));

require 'vendor/autoload.php';


$modules = [
    AdminModule::class,
    BlogModule::class,
];


$app = (new \Framework\App('config/config.php'))
       ->addModule(AdminModule::class)
       ->addModule(BlogModule::class)
       ->pipe(Whoops::class)
       ->pipe(TrailingSlashMiddleware::class)
       ->pipe(MethodMiddleware::class)
       ->pipe(CsrfMiddleware::class)
       ->pipe(RouterMiddleware::class)
       ->pipe(RouteDispatcherMiddleware::class)
       ->pipe(NotFoundMiddleware::class)
;


if (php_sapi_name() !== "cli") {
    $response = $app->run(ServerRequest::fromGlobals());
    \Http\Response\send($response);
}