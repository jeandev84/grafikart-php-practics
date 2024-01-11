<?php

use App\Admin\AdminModule;
use App\Auth\AuthModule;
use App\Auth\Security\Middleware\ForbiddenMiddleware;
use App\Blog\BlogModule;
use Framework\Middleware\{CsrfMiddleware,
    MethodMiddleware,
    NotFoundMiddleware,
    RouteDispatcherMiddleware,
    RouterMiddleware,
    TrailingSlashMiddleware};
use Framework\Middleware\Security\LoggedInMiddleware;
use GuzzleHttp\Psr7\ServerRequest;
use Middlewares\Whoops;


chdir(dirname(__DIR__));

require 'vendor/autoload.php';


$app = (new \Framework\App('config/config.php'))
       ->addModule(AdminModule::class)
       ->addModule(BlogModule::class)
       ->addModule(AuthModule::class);

$container = $app->getContainer();
$app->pipe(Whoops::class)
    ->pipe(TrailingSlashMiddleware::class)
    ->pipe(ForbiddenMiddleware::class)
    ->pipe($container->get('admin.prefix'), LoggedInMiddleware::class)
    ->pipe(MethodMiddleware::class)
    ->pipe(CsrfMiddleware::class)
    ->pipe(RouterMiddleware::class)
    ->pipe(RouteDispatcherMiddleware::class)
    ->pipe(NotFoundMiddleware::class);


if (php_sapi_name() !== "cli") {
    $response = $app->run(ServerRequest::fromGlobals());
    \Http\Response\send($response);
}