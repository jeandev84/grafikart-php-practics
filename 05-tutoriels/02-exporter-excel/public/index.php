<?php
ob_start();

use Grafikart\Http\Request\ServerRequest;

require '../vendor/autoload.php';

$app = require '../bootstrap/app.php';

$kernel = new \App\Http\Kernel($app);

$response = $kernel->handle(
    $request = ServerRequest::fromGlobals()
);

$response->send();

$kernel->terminate($request, $response);







