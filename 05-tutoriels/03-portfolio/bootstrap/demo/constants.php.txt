<?php

$directory = basename(dirname(dirname(__FILE__)));
$url = explode($directory, $_SERVER['REQUEST_URI']);
if (count($url) === 1) {
    $path = '/';
} else {
    $path = $url[0] . $directory;
}
define('BASE_PATH', dirname(__DIR__));
# define('WEBROOT', dirname($_SERVER['SCRIPT_NAME']));
define('WEBROOT', $path);