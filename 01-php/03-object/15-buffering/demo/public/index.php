<?php
require '../vendor/autoload.php';

# AltoRouter
# https://github.com/dannyvankooten/AltoRouter


$router = new AltoRouter();

require '../config/routes.php';

if($match = $router->match()) {
    if (is_callable($match['target'])) {
        call_user_func_array($match['target'], $match['params']);
    } else {
        extract($match['params'], EXTR_SKIP);
        ob_start();
        require "../templates/{$match['target']}.php";
        $pageContent = ob_get_clean();
    }
    require "../elements/layout.php";
} else {
    require '../templates/errors/404.php';
}
