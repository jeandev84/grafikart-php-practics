<?php
use App\App;

require '../vendor/autoload.php';
App::getAuth()->isGranted('admin');
?>

Réservé à l'admin