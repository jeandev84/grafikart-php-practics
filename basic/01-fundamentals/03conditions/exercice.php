<?php

$heure = (int) readline("Entrez une heure : ");

if ((9 <= $heure && $heure <= 12) || (14 <= $heure && $heure <= 17)) {
    echo "Le magasin est ouvert";
} else {
    echo "Le magasin sera ferme";
}

echo "\n";

/*
 TRUE  && TRUE   = TRUE
 TRUE  && FALSE  = FALSE
 FALSE && TRUE   = FALSE
 FALSE && FALSE  = FALSE

 TRUE  || TRUE    = TRUE
 TRUE  || FALSE   = TRUE
 FALSE || TRUE    = TRUE
 FALSE || FALSE   = FALSE
*/

// Inverse condition

$heure = (int) readline("Entrez une heure : ");

if (! ((9 <= $heure && $heure <= 12) || (14 <= $heure && $heure <= 17))) {
    echo "Le magasin sera ferme";
} else {
    echo "Le magasin est ouvert";
}

echo "\n";

// OUBIEN
$heure = (int) readline("Entrez une heure : ");

if (! (9 <= $heure && $heure <= 12) || ! (14 <= $heure && $heure <= 17)) {
    echo "Le magasin sera ferme";
} else {
    echo "Le magasin est ouvert";
}

echo "\n";


$heure = (int) readline("Entrez une heure : ");

if ((9 > $heure || $heure > 12) || ! (14 > $heure || $heure > 17)) {
    echo "Le magasin sera ferme";
} else {
    echo "Le magasin est ouvert";
}

echo "\n";
