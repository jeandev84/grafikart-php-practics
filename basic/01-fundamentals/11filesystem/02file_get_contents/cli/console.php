<?php

// Chemin absolu

$filePath = str_replace('/', DIRECTORY_SEPARATOR, __DIR__.'/storage/demo.txt');


// Deconseiller d' utiliser file_get_contents() pour lire une URL
// Utiliser seulement file_get_contents() pour lire des fichiers sur sa machine.

echo file_get_contents('http://jsonplaceholder.typicode.com/posts');


// Utiliser FLAGS [ FILE_APPEND ] pour ajouter du contenu a la suite
echo file_get_contents($filePath);

