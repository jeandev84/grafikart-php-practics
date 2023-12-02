<?php

$router  = new Grafikart\Routing\Router();


# BLOG
$router->get('/', [\App\Controller\Blog\PostController::class, 'index'], 'posts.list');
$router->get('/post/{id}', [\App\Controller\Blog\PostController::class, 'show'], 'post.show')
       ->number('id');
$router->get('/category/{id}', [\App\Controller\Blog\CategoryController::class, 'show'], 'category.show')
       ->number('id');



# LOGIN
$router->map('GET|POST', '/login', [\App\Controller\Auth\LoginController::class, 'index'], 'auth.login');
$router->post('/logout', [\App\Controller\Auth\LogoutController::class, 'index'], 'auth.logout');


# ADMIN POSTS
$router->get('/admin', [\App\Controller\Admin\PostController::class, 'index'], 'admin.posts.list');
$router->map('GET|POST', '/admin/post/create', [\App\Controller\Admin\PostController::class, 'create'], 'admin.post.create');
$router->map('GET|POST', '/admin/post/{id}/edit', [\App\Controller\Admin\PostController::class, 'edit'], 'admin.post.edit')
    ->number('id');
$router->map('GET|POST', '/admin/post/delete/{id}', [\App\Controller\Admin\PostController::class, 'delete'], 'admin.post.delete')
    ->number('id');


# ADMIN CATEGORY
$router->get('/admin/categories', [\App\Controller\Admin\CategoryController::class, 'index'], 'admin.categories.list');
$router->map('GET|POST', '/admin/category/create', [\App\Controller\Admin\CategoryController::class, 'create'], 'admin.category.create');
$router->map('GET|POST', '/admin/category/{id}/edit', [\App\Controller\Admin\CategoryController::class, 'edit'], 'admin.category.edit')
    ->number('id');
$router->map('GET|POST', '/admin/category/delete/{id}', [\App\Controller\Admin\CategoryController::class, 'delete'], 'admin.category.delete')
    ->number('id');


return $router;