<?php

require __DIR__.'/../vendor/autoload.php';

$app = require __DIR__.'/../bootstrap/app.php';

$kernel = new \App\Kernel($app);
$response = $kernel->handle(
    $request = \Grafikart\Http\Request::createFromGlobals()
);

$response->send();
$kernel->terminate($request, $response);





