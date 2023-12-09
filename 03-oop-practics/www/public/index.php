<?php

use App\Account\AccountModule;
use App\Admin\AdminModule;
use App\Auth\AuthModule;
use App\Auth\Security\Middleware\ForbiddenMiddleware;
use App\Blog\BlogModule;
use App\Contact\ContactModule;
use App\Framework\Middleware\Security\RoleMiddleware;
use App\Framework\Middleware\Security\RoleMiddlewareFactory;
use Framework\Middleware\{CsrfMiddleware,
    MethodMiddleware,
    NotFoundMiddleware,
    RouteDispatcherMiddleware,
    RouterMiddleware,
    TrailingSlashMiddleware};
use Framework\Middleware\Security\LoggedInMiddleware;
use Framework\Security\Auth;
use GuzzleHttp\Psr7\ServerRequest;
use Middlewares\Whoops;


chdir(dirname(__DIR__));

require 'vendor/autoload.php';


$app = (new \Framework\App('config/config.php'))
       ->addModule(AdminModule::class)
       ->addModule(ContactModule::class)
       ->addModule(BlogModule::class)
       ->addModule(AuthModule::class)
       ->addModule(AccountModule::class)
;

$container = $app->getContainer();
$app->pipe(Whoops::class)
    ->pipe(TrailingSlashMiddleware::class)
    ->pipe(ForbiddenMiddleware::class)
    /* ->pipe($container->get('admin.prefix'), LoggedInMiddleware::class)
    ->pipe($container->get('admin.prefix'), new RoleMiddleware($container->get(Auth::class), 'admin'))
    */
    ->pipe(
        $container->get('admin.prefix'),
        $container->get(RoleMiddlewareFactory::class)->makeForRole('admin')
    )
    ->pipe(MethodMiddleware::class)
    ->pipe(CsrfMiddleware::class)
    ->pipe(RouterMiddleware::class)
    ->pipe(RouteDispatcherMiddleware::class)
    ->pipe(NotFoundMiddleware::class);


if (php_sapi_name() !== "cli") {
    $response = $app->run(ServerRequest::fromGlobals());
    \Http\Response\send($response);
}