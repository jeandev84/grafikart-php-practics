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

$app->bind('app.config', $config);

$app->bind(SessionInterface::class, function () {
    // TODO move logic starting session in middleware
     return new Session();
});

$app->bind(PdoConnection::class, function () use ($config) {
    return PdoConnection::make($config['database']);
});

$app->bind(RequestHandlerInterface::class, function () {
    return new QueueRequestHandler(new NotFoundHandler());
});

$app->bind(Router::class, function () {
    $router = new Router();
    $routes = require BASE_PATH . '/config/routes.php';
    return $routes($router);
});

$app->bind('auth', function (Container $app) {
    $connection = $app->get(PdoConnection::class);
    $session    = $app->get(SessionInterface::class);
    $provider   = new \App\Security\Providers\UserProvider($connection);
    $storage    = new \App\Security\Token\UserTokenStorage($session);
    return new Auth(
        new UserAuthenticator($provider)
    );
});

$app->bind(Renderer::class, function () {
    return new Renderer(BASE_PATH . '/views');
});

return $app;