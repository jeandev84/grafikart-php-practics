<?php
session_start();

/*
$_SESSION['role'] = 'administrateur';
unset($_SESSION['role']);
session_write_close() : permet d' ecrire des informations que nous avons definit au niveau du fichier.
                        Execute a la fin de l' execution de notre script
*/

$_SESSION['user'] = [
   'username' => 'John',
   'password' => '0000'
];

$title = "Page d'accueil";
require 'elements/header.php';
?>

<div class="starter-template">
    <h1>Bootstrap starter template</h1>
    <p class="lead">Use this document as a way to quickly start any new project.<br> All you get is this text and a mostly barebones HTML document.</p>
</div>

<?php require 'elements/footer.php'; ?>

