<?php

require __DIR__.'/../vendor/autoload.php';

$renderer = new \Framework\Templating\Renderer();
$renderer->addPath(dirname(__DIR__). '/views');


$app = new \Framework\App([
    \App\Blog\BlogModule::class
], [
    'renderer' => $renderer
]);

$response = $app->run(\GuzzleHttp\Psr7\ServerRequest::fromGlobals());
\Http\Response\send($response);