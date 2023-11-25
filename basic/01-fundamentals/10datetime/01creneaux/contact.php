<?php
$title = "Nous contacter";
require_once 'config.php';
require_once 'functions.php';
$creneaux = creneauxHtml(CRENEAUX);

require 'header.php';
?>


<div class="row">
    <div class="col-md-8">

        <h2>Nous contacter</h2>

        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi earum eos facilis harum in laboriosam, magni sed sit tempore veniam.</p>

    </div>
    <div class="col-md-4">
        <h2>Horaire d' ouvertures</h2>
        <?= $creneaux ?>
    </div>
</div>
<?php require 'footer.php'; ?>
