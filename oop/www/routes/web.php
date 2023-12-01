<?php

$router  = new Grafikart\Routing\Router();
$router->get('/home', [\App\Controller\SiteController::class, 'index'], 'home');
$router->get('/single', [\App\Controller\SiteController::class, 'single'], 'single');
$router->get('/portfolio', [\App\Controller\PostController::class, 'index'], 'portfolio');

return $router;