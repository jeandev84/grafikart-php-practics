<?php
session_start();

// AUTHENTIFICATION
require_once 'functions/auth.php';

// $_SESSION['connected'] = 1;
// unset($_SESSION['connected']);
// var_dump(is_connected());
/*
if (! is_connected()) {
    header('Location: /login.php');
    exit();
}
*/

force_user_connected();


//
require_once 'functions/compteur.php';

$year  = (int) date('Y');

/*
$yearSelected  = empty($_GET['year']) ? $year : (int) $_GET['year'];
$monthSelected = empty($_GET['month']) ? date('m') : (int) $_GET['month'];
*/

$yearSelected  = empty($_GET['year']) ? null : (int) $_GET['year'];
$monthSelected = empty($_GET['month']) ? null : $_GET['month'];


if ($yearSelected && $monthSelected) {
    $total  = nombre_vues_mois($yearSelected, $monthSelected);
    $detail = nombre_vues_details_mois($yearSelected, $monthSelected);
} else {
    $total = nombre_vues();
}

// MONTH LIST
$months = [
  '01' => 'Janvier',
  '02' => 'Fevrier',
  '03' => 'Mars',
  '04' => 'Avril',
  '05' => 'Mai',
  '06' => 'Juin',
  '07' => 'Juillet',
  '08' => 'Aout',
  '09' => 'Septembre',
  '10' => 'Octobre',
  '11' => 'Novembre',
  '12' => 'Decembre',
];


require 'elements/header.php';
?>

<div class="row">
    <div class="col-md-4">
        <div class="list-group">
             <!-- Lister les 5 deniers annees -->
             <!-- /dashboard.php?year=2019 -->
             <?php for ($i = 0; $i < 5; $i++): ?>

               <a class="list-group-item <?= (($year - $i) === $yearSelected) ? 'active' : ''; ?>" href="dashboard.php?year=<?= ($year - $i) ?>">
                   <?= ($year - $i) ?>
               </a>

               <!-- Afficher l' ensemble des mois -->
               <?php if (($year - $i) === $yearSelected): ?>
                  <div class="list-group">
                      <?php foreach ($months as $k => $month): ?>
                          <a  class="list-group-item<?= ($k === $monthSelected) ? ' active' : ''; ?>"  href="dashboard.php?year=<?= $yearSelected ?>&month=<?= $k ?>">
                               <?= $month ?>
                          </a>
                      <?php endforeach; ?>
                  </div>
               <?php endif; ?>
             <?php endfor; ?>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card mb-4">
            <div class="card-body">
                <strong style="font-size: 3em;"><?= $total ?></strong>
                <p>Visite<?= ($total > 1) ? 's' : ''; ?> total</p>
            </div>
        </div>
        <?php if (isset($detail)): ?>
            <h2>Details des visites pour le mois</h2>
            <table class="table table-striped">
                <thead>
                   <tr>
                       <th>Jour</th>
                       <th>Nombre de visites</th>
                   </tr>
                </thead>
                <tbody>
                    <?php foreach ($detail as $line): ?>
                        <tr>
                            <td><?= $line['jour'] ?></td>
                            <td><?= $line['visites'] ?> visite<?= $line['visites'] > 1 ? 's' : '' ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</div>

<?php require 'elements/footer.php'; ?>

