<?php

$router->get('/', [\App\Controller\PostController::class, 'index'], 'home');
$router->get('/blog/category/[*:slug]-[i:id]', 'category/show', 'category');
$router->get('/blog/[*:slug]-[i:id]', 'post/show', 'post');
$router->map('GET|POST', '/login', 'auth/login', 'login');
$router->post( '/logout', 'auth/logout', 'logout');


// ADMIN
// Gestions des articles
$router->get('/admin', 'admin/post/index', 'admin.posts');
$router->map('GET|POST', '/admin/post/[i:id]', 'admin/post/edit', 'admin.post');
$router->post('/admin/post/[i:id]/delete', 'admin/post/delete', 'admin.post.delete');
$router->map('GET|POST', '/admin/post/new', 'admin/post/new', 'admin.post.new');


// ADMIN
// Gestions des categories
$router->get('/admin/categories', 'admin/category/index', 'admin.categories');
$router->map('GET|POST', '/admin/category/[i:id]', 'admin/category/edit', 'admin.category');
$router->post('/admin/category/[i:id]/delete', 'admin/category/delete', 'admin.category.delete')
    ->map('GET|POST', '/admin/category/new', 'admin/category/new', 'admin.category.new');

// Routing
/*
$router->get('/', 'post/index', 'home');
$router->get('/blog/category/[*:slug]-[i:id]', 'category/show', 'category');
$router->get('/blog/[*:slug]-[i:id]', 'post/show', 'post');
$router->map('GET|POST', '/login', 'auth/login', 'login');
$router->post( '/logout', 'auth/logout', 'logout');


// ADMIN
// Gestions des articles
$router->get('/admin', 'admin/post/index', 'admin.posts');
$router->map('GET|POST', '/admin/post/[i:id]', 'admin/post/edit', 'admin.post');
$router->post('/admin/post/[i:id]/delete', 'admin/post/delete', 'admin.post.delete');
$router->map('GET|POST', '/admin/post/new', 'admin/post/new', 'admin.post.new');


// ADMIN
// Gestions des categories
$router->get('/admin/categories', 'admin/category/index', 'admin.categories');
$router->map('GET|POST', '/admin/category/[i:id]', 'admin/category/edit', 'admin.category');
$router->post('/admin/category/[i:id]/delete', 'admin/category/delete', 'admin.category.delete')
       ->map('GET|POST', '/admin/category/new', 'admin/category/new', 'admin.category.new');
*/
