<?php


// Tant que la condition n'est pas remplie on demandera toujours a l' utilisateur de rentrer une valeur

$chiffre = null;

while ($chiffre !== 10) {
    $chiffre = (int) readline("Entrez une heure : ");
}

echo "Bravo vous avez gagnez!\n";

// =========================================================================
// Sort de la boucle meme si la condition n' est pas remplit

$chiffre = null;


// Tant que la condition n'est pas remplie on demandera toujours a l' utilisateur de rentrer une valeur
while ($chiffre !== 10) {
    $chiffre = (int) readline("Entrez une heure : ");
    break;
}

echo "Bravo vous avez gagnez!\n";
