<?php

use Framework\Middleware\CsrfMiddleware;
use Framework\Routing\Router;
use Framework\Session\PHPSession;
use Framework\Session\SessionInterface;
use Framework\Templating\Renderer\RendererInterface;
use Framework\Templating\Renderer\TwigRendererFactory;
use Framework\Twig\CsrfExtension;
use Framework\Twig\FlashExtension;
use Framework\Twig\FormExtension;
use Framework\Twig\PagerFantaExtension;
use Framework\Twig\RouterTwigExtension;
use Framework\Twig\TextExtension;
use Framework\Twig\TimeExtension;

return [
    'env'               => \DI\env('ENV', 'production'),
    'database.host'     => 'localhost',
    'database.username' => 'root',
    'database.password' => 'secret',
    'database.name'     => 'monsupersite',
    'views.path'        => dirname(__DIR__). '/views',
    'twig.extensions'   => [
        \DI\get(RouterTwigExtension::class),
        \DI\get(PagerFantaExtension::class),
        \DI\get(TextExtension::class),
        \DI\get(TimeExtension::class),
        \DI\get(FlashExtension::class),
        \DI\get(FormExtension::class),
        \DI\get(CsrfExtension::class),
    ],
    SessionInterface::class => \DI\object(PHPSession::class),
    CsrfMiddleware::class => \DI\object()->constructor(\DI\get(SessionInterface::class)),
    Router::class => \DI\object(),
    RendererInterface::class => \DI\factory(TwigRendererFactory::class),
    PDO::class => function(\Psr\Container\ContainerInterface $container) {

       $host     = $container->get('database.host');
       $database = $container->get('database.name');
       $username = $container->get('database.username');
       $password = $container->get('database.password');
       $dsn  = sprintf('mysql:host=%s;dbname=%s;', $host, $database);

       return new PDO($dsn, $username, $password, [
           PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
           PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
       ]);
    }
];