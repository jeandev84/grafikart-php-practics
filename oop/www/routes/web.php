<?php

$router  = new Grafikart\Routing\Router();
$router->get('/home', [\App\Controller\SiteController::class, 'index'], 'home');
$router->get('/single', [\App\Controller\SiteController::class, 'single'], 'single');

return $router;