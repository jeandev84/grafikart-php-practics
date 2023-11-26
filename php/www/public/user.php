<?php
use App\App;

require '../vendor/autoload.php';
App::getAuth()->isGranted('user', 'admin');
?>
Réservé à l'utilisateur