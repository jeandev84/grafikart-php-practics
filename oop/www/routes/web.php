<?php

$router  = new Grafikart\Routing\Router();

$router->get('/', [\App\Controller\PostController::class, 'index'], 'posts.list');
$router->get('/post/{id}', [\App\Controller\PostController::class, 'show'], 'post.show')
       ->number('id');
$router->get('/category/{id}', [\App\Controller\CategoryController::class, 'show'], 'category.show')
       ->number('id');
return $router;