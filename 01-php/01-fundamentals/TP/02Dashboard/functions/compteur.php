<?php


/*
Obtenir le chemin du fichier
Verifier si le fichier compteur existe
Si le fichier existe alors on l' incremente
Sinon on cree le fichier avec la valeur 1.
*/
function ajouter_vue() {

     $fichier = dirname(__DIR__). DIRECTORY_SEPARATOR.'data'. DIRECTORY_SEPARATOR . 'compteur';
     $fichier_journalier = $fichier . '-' . date('Y-m-d');


     // Compteur de vues global
     incrementer_compteur($fichier);

     // Compteur de vues journalier
     incrementer_compteur($fichier_journalier);
}




function incrementer_compteur(string $fichier) {

    $compteur = 1;

    if (file_exists($fichier)) {
        $compteur = (int)file_get_contents($fichier);
        $compteur++;
    }

    file_put_contents($fichier, $compteur);
}


function nombre_vues(): string {

    $fichier = dirname(__DIR__). DIRECTORY_SEPARATOR.'data'. DIRECTORY_SEPARATOR . 'compteur';

    return file_get_contents($fichier);
}


/**
 * @param int $year
 * @param int $month
 * @return int
*/
function nombre_vues_mois(int $year, int $month): int {

    // 01, 02, 03 ...
    $month = str_pad($month, 2, '0', STR_PAD_LEFT);

    // /to/php/www/data/compteur-2022-02-* (generer en fonction de la selection d' annee et de mois
    $fichier = dirname(__DIR__).
               DIRECTORY_SEPARATOR.'data'.
               DIRECTORY_SEPARATOR .
               'compteur-' .
               $year .
               '-' .
               $month .
               '-*';

    $fichiers = glob($fichier);
    $total    = 0;

    foreach ($fichiers as $fichier) {
        $total += (int) file_get_contents($fichier);
    }

    return $total;
}


/*
function nombre_vues_mois_example(int $year, string $month) {

    $fichier = dirname(__DIR__).
        DIRECTORY_SEPARATOR.'data'.
        DIRECTORY_SEPARATOR .
        'compteur-' .
        $year .
        '-' .
        $month
    ;
}
*/



/**
 * @param int $year
 * @param int $month
 * @return array
*/
function nombre_vues_details_mois(int $year, int $month): array {

    // 01, 02, 03 ...
    $month = str_pad($month, 2, '0', STR_PAD_LEFT);

    // /to/php/www/data/compteur-2022-02-* (generer en fonction de la selection d' annee et de mois
    $fichier = dirname(__DIR__).
        DIRECTORY_SEPARATOR.'data'.
        DIRECTORY_SEPARATOR .
        'compteur-' .
        $year .
        '-' .
        $month .
        '-*';

    $fichiers = glob($fichier);

    $visites = [];

    foreach ($fichiers as $fichier) {

       $parties = explode('-', basename($fichier));

       $visites[] = [
          'annee'   => $parties[1],
          'mois'     => $parties[2],
          'jour'     => $parties[3],
          'visites'  => file_get_contents($fichier)
       ];
    }

    return $visites;
}
