<?php

$router->get('/', [\App\Controller\Blog\PostController::class, 'index'], 'home');
$router->get('/blog/category/[*:slug]-[i:id]', [\App\Controller\Blog\CategoryController::class, 'show'], 'category');
$router->get('/blog/[*:slug]-[i:id]', [\App\Controller\Blog\PostController::class, 'show'], 'post');
$router->map('GET|POST', '/login', [\App\Controller\Auth\LoginController::class, 'login'], 'login');
$router->post( '/logout', [\App\Controller\Auth\LogoutController::class, 'logout'], 'logout');


// ADMIN
// Gestions des articles
$router->get('/admin', [\App\Controller\Admin\PostController::class, 'index'], 'admin.posts');
$router->map('GET|POST', '/admin/post/[i:id]', [\App\Controller\Admin\PostController::class, 'edit'], 'admin.post');
$router->post('/admin/post/[i:id]/delete', [\App\Controller\Admin\PostController::class, 'delete'], 'admin.post.delete');
$router->map('GET|POST', '/admin/post/new', [\App\Controller\Admin\PostController::class, 'create'], 'admin.post.new');


// ADMIN
// Gestions des categories
$router->get('/admin/categories', [\App\Controller\Admin\CategoryController::class, 'index'], 'admin.categories');
$router->map('GET|POST', '/admin/category/[i:id]', [\App\Controller\Admin\CategoryController::class, 'edit'], 'admin.category');
$router->post('/admin/category/[i:id]/delete', [\App\Controller\Admin\CategoryController::class, 'delete'], 'admin.category.delete')
       ->map('GET|POST', '/admin/category/new', [\App\Controller\Admin\CategoryController::class, 'create'], 'admin.category.new');
