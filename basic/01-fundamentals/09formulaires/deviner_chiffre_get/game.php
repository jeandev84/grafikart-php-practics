<?php

/*
 * Deviner le chiffre
*/

$deviner = 150;


$value  = "";
$error   = null;
$success = null;
$value   = null;

if (isset($_GET['number'])) {

    $value = $_GET['number'];

    if ($value > $deviner) {
       $error = "Votre chiffre est trop grand.";
    } elseif ($value < $deviner) {
        $error = "Votre chiffre est trop petit";
    }else {
        $success = "Bravo! Vous avez deviner le chiffre <strong>$deviner</strong>";
    }

    $value = (int) $value;
    // $value = escape($value);
}
require 'header.php';

?>


<?php if ($error): ?>
  <div class="alert alert-danger">
      <?= $error?>
  </div>
<?php elseif($success): ?>
  <div class="alert alert-success">
      <?= $success?>
  </div>
<?php endif; ?>

<form action="/game.php" method="GET">
    <div class="form-group">
        <input type="number" name="number" class="form-control" placeholder="Entre 0 et 1000" value="<?= $value ?>">
    </div>
    <!--
    <div class="form-group">
        <input type="text" name="demo"  class="form-control" value="test">
    </div>
    -->
    <button type="submit" class="btn btn-primary">Deviner</button>
</form>

<?php require 'footer.php'; ?>