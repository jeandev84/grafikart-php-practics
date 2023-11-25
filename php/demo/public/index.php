<?php
require '../vendor/autoload.php';

require '../elements/header.php';
$uri = $_SERVER['REQUEST_URI'];

switch ($uri):
    case '/contact-us': require '../templates/contact.php'; break;
    case '/home': require '../templates/home.php'; break;
    default: require '../templates/errors/404.php'; break;
endswitch;

require '../elements/footer.php';

