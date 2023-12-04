<?php
require '../vendor/autoload.php';

# AltoRouter
# https://github.com/dannyvankooten/AltoRouter


$router = new AltoRouter();

$router->map('GET', '/', 'home');
$router->map('GET', '/contact-us', 'contact', 'contact');
$router->map('GET', '/blog/[*:slug]-[i:id]', 'blog/article', 'article');

if($match = $router->match()) {
    require '../elements/header.php';
    if (is_callable($match['target'])) {
        call_user_func_array($match['target'], $match['params']);
    } else {
        $params = $match['params'];
        require "../templates/{$match['target']}.php";
    }

    require '../elements/footer.php';
} else {
    require '../templates/errors/404.php';
}
