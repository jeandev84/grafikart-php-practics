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