<?php

$router  = new Grafikart\Routing\Router();
$router->get('/home', [\App\Controller\SiteController::class, 'index']);
$router->get('/single', [\App\Controller\SiteController::class, 'single']);

return $router;