<?php

$router  = new Grafikart\Routing\Router();

$router->get('/', [\App\Controller\Blog\PostController::class, 'index'], 'posts.list');
$router->get('/post/{id}', [\App\Controller\Blog\PostController::class, 'show'], 'post.show')
       ->number('id');
$router->get('/category/{id}', [\App\Controller\Blog\CategoryController::class, 'show'], 'category.show')
       ->number('id');
return $router;