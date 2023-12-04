<?php

use Framework\Templating\Renderer\RendererInterface;

require __DIR__.'/../vendor/autoload.php';


# https://php-di.org/doc/getting-started.html
$builder = new \DI\ContainerBuilder();
$builder->addDefinitions(dirname(__DIR__). '/config/config.php');
$builder->addDefinitions(dirname(__DIR__). '/config.php');
$container = $builder->build();


# Application
$app = new \Framework\App($container, [
    \App\Blog\BlogModule::class
]);

# Response
$response = $app->run(\GuzzleHttp\Psr7\ServerRequest::fromGlobals());
\Http\Response\send($response);