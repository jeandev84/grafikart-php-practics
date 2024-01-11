<?php

use Framework\Templating\Renderer\RendererInterface;

require __DIR__.'/../vendor/autoload.php';


$modules = [
    \App\Blog\BlogModule::class
];


# https://php-di.org/doc/getting-started.html
$builder = new \DI\ContainerBuilder();
$builder->addDefinitions(dirname(__DIR__). '/config/config.php');
foreach ($modules as $module) {
    if ($module::DEFINITIONS) {
        $builder->addDefinitions($module::DEFINITIONS);
    }
}
$builder->addDefinitions(dirname(__DIR__). '/config.php');
$container = $builder->build();


# Application
$app = new \Framework\App($container, $modules);

# Response
$response = $app->run(\GuzzleHttp\Psr7\ServerRequest::fromGlobals());
\Http\Response\send($response);