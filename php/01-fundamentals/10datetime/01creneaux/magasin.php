<?php

/*
 * Titre du project
*/
$title = "Composer votre glace";



/*
 * Symbol currency
*/
$currency = '€';


/*
 Elements de GLACE compose de [name => price]
*/

// Checkbox
$parfums = [
   'Fraise'   => 4,
   'Chocolat' => 5,
   'Vanille'  => 3
];


// Radio
$cornets = [
   'Pot'    => 2,
   'Cornet' => 3
];


// Checkbox
$supplements = [
   'Pepite de chocolat' => 1,
   'Chantilly' => 0.5
];



/*
  Ingredients choisi par l' utilisateur
*/

$ingredients = [];


/*
 Prix total des ingredients choisis
*/

$total = 0;


/*
 * Parcour des ingredients et assigner le prix total
*/


foreach (['parfum', 'supplement', 'cornet'] as $index) {

    if (isset($_GET[$index])) {

        $listName  = $index .'s';
        $choice    = $_GET[$index];

        if (is_array($choice)) {
            foreach ($choice as $value) {
                if (isset($$listName[$value])) {
                    $ingredients[] = $value;
                    $total += $$listName[$value];
                }
            }
        } else {
            if (isset($$listName[$choice])) {
                $ingredients[] = $choice;
                $total += $$listName[$choice];
            }
        }
    }
}


/*
if (isset($_GET['parfum'])) {
    foreach ($_GET['parfum'] as $parfum) {
          if (isset($parfums[$parfum])) {
               $ingredients[] = $parfum;
               $total += $parfums[$parfum];
          }
    }
}


if (isset($_GET['supplement'])) {
    foreach ($_GET['supplement'] as $supplement) {
        if (isset($supplements[$supplement])) {
            $ingredients[] = $supplement;
            $total += $supplements[$supplement];
        }
    }
}



if (isset($_GET['cornet'])) {
    $cornet = $_GET['cornet'];
    if (isset($cornets[$cornet])) {
        $ingredients[] = $cornet;
        $total += $cornets[$cornet];
    }
}

*/



require 'header.php';

?>

<h1>Composer votre glace</h1>

<div class="row">
    <div class="col-md-4">
        <div class="card">
             <div class="card-body">
                 <h5 class="card-title">Votre glace</h5>
                 <ul>
                     <?php foreach ($ingredients as $ingredient): ?>
                         <li><?= $ingredient ?></li>
                     <?php endforeach; ?>
                 </ul>
                 <p>
                     <strong>Prix : </strong> <?= $total ?> €
                 </p>
             </div>
        </div>
    </div>
    <div class="col-md-8">
        <form action="/magasin.php" method="GET">
            <!-- List parfums -->
            <h2>Choisissez vos parfums</h2>
            <?php foreach ($parfums as $parfum => $price): ?>
                <div class="checkbox">
                    <label for="fraise">
                        <?= checkbox('parfum', $parfum, $_GET) ?>
                        <?= $parfum ?> - <?= $price ?> €
                    </label>
                </div>
            <?php endforeach; ?>

            <!-- List cornets -->
            <h2>Choisissez votre cornet</h2>
            <?php foreach ($cornets as $cornet => $price): ?>
                <div class="checkbox">
                    <label for="cornet">
                        <?= radio('cornet', $cornet, $_GET) ?>
                        <?= $cornet ?> - <?= $price ?> €
                    </label>
                </div>
            <?php endforeach; ?>

            <!-- List supplements -->
            <h2>Chosissez vos supplements</h2>
            <?php foreach ($supplements as $supplement => $price): ?>
                <div class="checkbox">
                    <label for="supplement">
                        <?= checkbox('supplement', $supplement, $_GET) ?>
                        <?= $supplement ?> - <?= $price ?> €
                    </label>
                </div>
            <?php endforeach; ?>

            <button type="submit" class="btn btn-primary">Composer ma glace</button>
        </form>
    </div>
</div>

<?php debug(); ?>

<!-- Maket Formulaire
<h1>Composer votre glace</h1>
<form action="/game.php" method="GET">
    <div class="form-group">
        <input type="checkbox" name="parfum[]" value="Fraise"> Fraise <br>
        <input type="checkbox" name="parfum[]" value="Vanille"> Vanille <br>
        <input type="checkbox" name="parfum[]" value="Chocolat"> Chocolat <br>
    </div>
    <button type="submit" class="btn btn-primary">Deviner</button>
</form>
-->

<?php require 'footer.php'; ?>

