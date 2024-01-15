<?php

// bindings
use App\Http\Handlers\NotFoundHandler;
use App\Security\Authenticators\UserAuthenticator;
use App\Security\Token\CsrfToken;
use Grafikart\Config\Config;
use Grafikart\Container\Container;
use Grafikart\Database\Connection\PdoConnection;
use Grafikart\Http\Handlers\QueueRequestHandler;
use Grafikart\Http\Handlers\RequestHandlerInterface;
use Grafikart\Http\Session\Session;
use Grafikart\Http\Session\SessionInterface;
use Grafikart\Routing\Router;
use Grafikart\Security\Auth;
use Grafikart\Security\Token\Csrf\CsrfTokenInterface;
use Grafikart\Templating\Renderer;

require __DIR__.'/constants.php';
$config = require BASE_PATH . '/config/app.php';

$app = Container::instance();

$app->bind('basePath', BASE_PATH);
$app->bind('uploadDir', BASE_PATH. '/public/uploads');
$app->bind(Config::class, function () use ($config) {
    return new Config($config);
});

$app->bind(SessionInterface::class, function () {
    // TODO move logic starting session in middleware
     return new Session();
});

$app->bind(PdoConnection::class, function () use ($config) {
    return PdoConnection::make($config['database']);
});

$app->bind(RequestHandlerInterface::class, function (Container $app) {
    return new QueueRequestHandler(
        new NotFoundHandler($app)
    );
});

$app->bind(Router::class, function () {
    $router = new Router();
    $routes = require BASE_PATH . '/config/routes.php';
    return $routes($router);
});

$app->bind('auth', function (Container $app) {
    $connection = $app[PdoConnection::class];
    $session    = $app[SessionInterface::class];
    $provider   = new \App\Security\Providers\UserProvider($connection);
    $storage    = new \App\Security\Token\UserTokenStorage($session);
    return new Auth(new UserAuthenticator($provider, $storage));
});

$app->bind(CsrfTokenInterface::class, function (Container $app) {
   return new CsrfToken($app[SessionInterface::class]);
});

$app->bind(Renderer::class, function (Container $app) {

    $view       = new Renderer(BASE_PATH . '/views');
    $csrfToken  = $app[CsrfTokenInterface::class];

    $view->addGlobals([
       'session' => $app[SessionInterface::class],
       'router'  => $app[Router::class],
       'csrf'    => $app[CsrfTokenInterface::class],
       'csrfToken' => $csrfToken->generateToken()
    ]);

    return $view;
});

return $app;