<?php
ob_start();

use Grafikart\Http\Request\ServerRequest;

require __DIR__.'/../vendor/autoload.php';

$app = require __DIR__.'/../bootstrap/app.php';

$kernel = new \App\Http\Kernel($app);

$response = $kernel->handle(
    $request = ServerRequest::fromGlobals()
);

$response->send();

$kernel->terminate($request, $response);








