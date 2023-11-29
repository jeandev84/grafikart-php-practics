<?php

require __DIR__.'/../vendor/autoload.php';

define('DEBUG_TIME', microtime(true));

$container = new Grafikart\Container\Container();

$kernel = new \App\Kernel($container);

$kernel->process();

/*
$response = $kernel->handle(
    $request = \Grafikart\Http\Request\Request::createFromGlobals()
);

$response->send();

$kernel->terminate($request, $response);
*/


