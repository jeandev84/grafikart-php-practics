<?php
session_start();

$title = "Nous contacter";
require_once 'data/config.php';
require_once 'functions.php';

// Timezone date('e'); par default UTC
// date_default_timezone_set('Europe/Paris');
date_default_timezone_set('Europe/Moscow');


// Recuperer l' heure d' aujourd' hui $heure
$heure = (int) ($_GET['heure'] ?? date('G'));
$jour  = (int) ($_GET['jour'] ?? date('N') - 1);

// Recuperer les creneaux d' aujourd' hui  $creneaux
$creneaux = CRENEAUX[$jour];

/*
dump($heure);
dump($creneaux);
*/


// Recuperer l' etat d' ouverture du magasin
$ouvert = in_creneaux($heure, $creneaux);

$color = $ouvert ? 'green' : 'red';

require 'elements/header.php';
?>


<div class="row">
    <div class="col-md-8">
        <h2>Debug</h2>
        <pre>
            <?= print_r($_SESSION) ?>
        </pre>
        <h2>Nous contacter</h2>

        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi earum eos facilis harum in laboriosam, magni sed sit tempore veniam.</p>

    </div>
    <div class="col-md-4">
        <h2>Horaire d' ouvertures</h2>
        <!--
         - Lundi : De 9h a 12h et de 14h a 19h
         - Mardi : De 9h a 12h et de 14h a 19h
         ...
         - Dimanche : Ferme
         -->
        <? // = date('l d F Y'); ?>
        <? // = date('N'); ?> <!-- return le nombre de la semaine -->

        <?php if ($ouvert): ?>
            <div class="alert alert-success">
                Le magasin sera ouvert
            </div>
        <?php else: ?>
            <div class="alert alert-danger">
                Le magasin sera ferme
            </div>
        <?php endif; ?>

        <form action="" method="GET">
            <div class="form-group">
                <?= select('jour', $jour, JOURS) ?>
            </div>
            <div class="form-group">
                <input class="form-control" type="number" name="heure" value="<?= $heure ?>">
            </div>
            <button class="btn btn-primary" type="submit">Voir si le magasin est ouvert</button>
        </form>

        <ul>
            <?php foreach (JOURS as $k => $jour): ?>
                  <li>
                      <strong><?= $jour ?></strong>
                      <?=  creneauxHtml(CRENEAUX[$k]) ?>
                  </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>
<?php require 'elements/footer.php'; ?>
