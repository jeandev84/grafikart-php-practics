<?php

require __DIR__.'/../vendor/autoload.php';

session_start();

define('DEBUG_TIME', microtime(true));
define('UPLOAD_PATH', __DIR__. DIRECTORY_SEPARATOR . 'uploads');

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


