<?php

require __DIR__.'/../vendor/autoload.php';


# Twig Renderer
$renderer = new \Framework\Templating\Renderer\TwigRenderer(dirname(__DIR__). '/views');


# Application
$app = new \Framework\App([
    \App\Blog\BlogModule::class
], [
    'renderer' => $renderer
]);

# Response
$response = $app->run(\GuzzleHttp\Psr7\ServerRequest::fromGlobals());
\Http\Response\send($response);