<?php


function trailingSlashes() {

    $uri = $_SERVER['REQUEST_URI'];

    if (!empty($uri) && $uri[-1] === "/") {
        header('Location: '. substr($uri, 0, -1));
        header('HTTP/1.1 301 Moved Permanently');
        exit;
    }

    echo 'Bonjour';
}