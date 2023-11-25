<?php

/*

On veut demander a l' utilisateur de rentrer les horaires d' ouverture d'un magasin
On demande a l 'utilisateur de renter une heure et on lui dira si le magasin est ouvert
*/

/*
PSEUDO CODE OU ALGORITHM

// On demande a l' utilisateur de renter un creneaux c'est a dire:

   // On demande l' heure de debut
   // On demande l' heure de fin
   // On verifie que l' heure de debut < l' heure de fin
   // On demande si on veut rajouter un nouveau creneaux (o/n)

// On demande a l' utilisateur de renter une heure
// On affiche l 'etat d ' ouverture du magazin

$creneaux = [
   [9, 12], // 9 h  - 12h
   [14, 15] // 14 h - 15h
];

*/


/*
$creneaux = [];

while (true) {
    $debut = (int) readline("Heure d' ouverture : ");
    $fin   = (int) readline("Heure de fermeture : ");

    if($debut > $fin) {
        echo "Le creneaux ne peut pas etre enregistre car l' heure d' ouverture ($debut) est superieur a l' heure de fermeture ($fin) \n";
    } else {
        $creneaux[] = [$debut, $fin];
        $action = readline("Voulez vous enregister un nouveau creneau (o/n): ");
        if ($action === 'n') {
              break;
        }
    }
}


print_r($creneaux);

// Afficher le magasin  est ouvert de 14h a 18h et de 9h a 12h
$heure = (int) readline("A quelle heure voulez vous visiter le magasin ? : ");

$creneauTrouve = false;

foreach ($creneaux as $creneau) {
    if ($heure >= $creneau[0] && $heure <= $creneau[1]) {
        $creneauTrouve = true;
        break;
    }
}

if ($creneauTrouve) {
   echo "Le magasin sera ouvert";
} else {
    echo "Desole, le magasin sera ferme :(";
}

echo "\n";

*/


$creneaux = [];

while (true) {
    $debut = (int) readline("Heure d' ouverture : ");
    $fin   = (int) readline("Heure de fermeture : ");

    if($debut > $fin) {
        echo "Le creneaux ne peut pas etre enregistre car l' heure d' ouverture ($debut) est superieur a l' heure de fermeture ($fin) \n";
    } else {
        $creneaux[] = [$debut, $fin];
        $action = readline("Voulez vous enregister un nouveau creneau (o/n): ");
        if ($action === 'n') {
            break;
        }
    }
}



// Le magasin  est ouvert de 14h a 18h et de 9h a 12h

echo "Le magasin est ouvert de";

foreach ($creneaux as $index => $creneau) {
    if ($index > 0) {
        echo " et de ";
    }
    echo " {$creneau[0]}h a {$creneau[1]}h";
}

echo "\n";

$heure = (int) readline("A quelle heure voulez vous visiter le magasin ? : ");

$creneauTrouve = false;

foreach ($creneaux as $creneau) {
    if ($heure >= $creneau[0] && $heure <= $creneau[1]) {
        $creneauTrouve = true;
        break;
    }
}

if ($creneauTrouve) {
    echo "Le magasin sera ouvert";
} else {
    echo "Desole, le magasin sera ferme :(";
}

echo "\n";

