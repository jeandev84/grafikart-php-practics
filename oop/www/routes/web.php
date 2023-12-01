<?php

$router  = new Grafikart\Routing\Router();

$router->get('/', [\App\Controller\PostController::class, 'index'], 'home');
#$router->get('/home', [\App\Controller\SiteController::class, 'index'], 'home');
$router->get('/post/{id}', [\App\Controller\PostController::class, 'show'], 'post')
       ->number('id');

return $router;