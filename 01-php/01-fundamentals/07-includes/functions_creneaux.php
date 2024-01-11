<?php


/**
 * Demande d' entrer un creneau
 *
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
