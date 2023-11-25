<?php

// Chemin absolu

// $filePath = str_replace('/', DIRECTORY_SEPARATOR, dirname(__DIR__).'/storage/demo.txt');


$filePath = str_replace('/', DIRECTORY_SEPARATOR, __DIR__.'/storage/demo.txt');


// Utiliser FLAGS [ FILE_APPEND ] pour ajouter du contenu a la suite
$size = @file_put_contents($filePath, 'marc comment ca va ?', FILE_APPEND);

if ($size === false) {
    echo "Impossible d'ecrire dans le fichier.";
} else {
    echo "Ecriture reussie";
}

echo "\n";
