<?php
/*
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
*/

use Grafikart\Service\Image\ImageService;

require __DIR__.'/../vendor/autoload.php';


$image = new ImageService(__DIR__.'/uploads/works/16.jpg');

$image->resize(150, 150);







