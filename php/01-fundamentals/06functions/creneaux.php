<?php


/*
 Si l' utilisateur tape "o" on renvoie true
 Si l' utilisateur tape "n" on renvoie false
*/

/**
 * @param string $phrase
 * @return bool
 */
function answerYesOrNo(string $phrase): bool {

    while (true) {
        $response = readline($phrase. " (o)ui/(n)on : \n");
        if ($response === 'o') {
            return true;
        } elseif ($response === 'n') {
            return false;
        }
    }

}


/**
 * @param string $phrase
 * @return int[]
 */
function askCreneau(string $phrase = "Veuillez entrer un creneau"): array
{
    echo "$phrase \n";
    while (true) {
        $ouverture = (int) readline("Heure d' ouverture : ");
        if ($ouverture >= 0 && $ouverture <= 23) {
            break;
        }
    }

    while (true) {
        $fermeture = (int) readline("Heure de fermeture : ");
        if ($fermeture >= 0 && $fermeture <= 23 && $fermeture > $ouverture) {
            break;
        }
    }

    return [$ouverture, $fermeture];
}


// $result = answerYesOrNo('Voulez-vous continuer ?');
/* var_dump($result); */

/*
$creneau1 = askCreneau(); // [8,9]
$creneau2 = askCreneau("Veuillez entrer votre creneau: ");

var_dump($creneau1, $creneau2);
*/

/**
 * [
 *   [0, 19],
 *   [2, 18]
 * ]
 */
function askCreneaux(string $phrase = "Veuillez entrer vos creneaux") {
    $creneaux = [];
    $continue = true;
    while ($continue) {
        $creneaux[]  = askCreneau($phrase);
        $continue    = answerYesOrNo("Voulez-vous continuer ? ");
    }

    return $creneaux;
}

$creneaux = askCreneaux('Entrez vos creneaux');

var_dump($creneaux);;