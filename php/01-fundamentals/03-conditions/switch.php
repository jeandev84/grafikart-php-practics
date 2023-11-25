<?php

/*
$note = 12;
$note = '12'; // sera convertit en entier

if ($note >= 10) {
   echo "Bravo vous avez la moyenne.\n";
} else {
   // echo 'Dommage vous n\'avez pas la moyenne';
   echo "Dommage vous n'avez pas la moyenne\n";
}

===============================================================

$note = readline("Entrez votre note : ");

if ($note >= 10) {
    if ($note == 10) {
        echo "Vous avez juste la moyenne\n";
    }else {
        echo "Bravo vous avez la moyenne.\n";
    }
} else {
    // echo 'Dommage vous n\'avez pas la moyenne';
    echo "Dommage vous n'avez pas la moyenne\n";
}


===============================================================

$note = readline("Entrez votre note : ");

if ($note > 10) {
    echo "Bravo vous avez la moyenne.\n";
} elseif ($note == 10) {
    echo "Vous avez juste la moyenne\n";
} else {
    // echo 'Dommage vous n\'avez pas la moyenne';
    echo "Dommage vous n'avez pas la moyenne\n";
}


===============================================================


$note = (int) readline("Entrez votre note : ");

if ($note > 10) {
    echo "Bravo vous avez la moyenne.\n";
} elseif ($note === 10) {
    echo "Vous avez juste la moyenne\n";
} else {
    // echo 'Dommage vous n\'avez pas la moyenne';
    echo "Dommage vous n'avez pas la moyenne\n";
}

*/


$action = (int) readline("Entrez votre note (1: attaquer, 2: defendre, 3: passer mon tour): ");


if ($action === 1) {
    echo "J'attaque!";
} elseif ($action === 2) {
    echo "Je defends";
}elseif ($action === 3) {
    echo "Je ne fais rien";
}else {
    echo "Command inconnue";
}


switch ($action) {
    case 1:
        echo "J'attaque!";
        break;
    case 2:
        echo "Je defends";
        break;
    case 3:
        echo "Je ne fais rien";
        break;
    default:
        echo "Command inconnue";
}

echo "\n";