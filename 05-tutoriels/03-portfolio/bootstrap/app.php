<?php

// bindings
use App\Http\Handlers\NotFoundHandler;
use App\Security\Authenticators\UserAuthenticator;
use Grafikart\Container\Container;
use Grafikart\Database\Connection\PdoConnection;
use Grafikart\Http\Handlers\QueueRequestHandler;
use Grafikart\Http\Handlers\RequestHandlerInterface;
use Grafikart\Http\Session\Session;
use Grafikart\Http\Session\SessionInterface;
use Grafikart\Routing\Router;
use Grafikart\Security\Auth;
use Grafikart\Templating\Renderer;

require __DIR__.'/constants.php';
$config = require BASE_PATH . '/config/app.php';

$app = Container::instance();

// TODO move logic starting session in middleware
$app->bind(SessionInterface::class, function () {
     return new Session();
});

$app->bind('auth', function () {
    return new Auth(
        new UserAuthenticator()
    );
});

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