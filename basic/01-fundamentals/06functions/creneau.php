<?php


/*
 Si l' utilisateur tape "o" on renvoie true
 Si l' utilisateur tape "n" on renvoie false
*/

/**
 * @param $phrase
 * @return bool
*/
function answerYesOrNo($phrase): bool {

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
 * @param $phrase
 * @return int[]
 */
function askCreneau($phrase = "Veuillez entrer un creneau"): array
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


$creneau1 = askCreneau(); // [8,9]
$creneau2 = askCreneau("Veuillez entrer votre creneau: ");

var_dump($creneau1, $creneau2);