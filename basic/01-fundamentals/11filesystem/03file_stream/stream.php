<?php

// Chemin absolu

/*
    $filePath = realpath(__DIR__.DIRECTORY_SEPARATOR. '/storage/demo.csv');

// AFFICHE LE CONTENU TEL QU' IL EST ECRIT
echo file_get_contents($filePath);

*/


/*
POUR EDITER DES FICHIERS DE PETITE TAILLE
*/
// $filePath = realpath(__DIR__.DIRECTORY_SEPARATOR. '/storage/demo.csv');
// $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
//echo $lines[0] ."\n";



/*
POUR LES GROS FICHIERS IL FAUT UTILISER fopen(), fwrite(), fgets(), fclose()
L' Avantage est qu'il permet de naviguer dans de tres gros fichier
*/

// fread() : permet de lire dans fichier a un taille precise ou infinie
// $filePath = realpath(__DIR__.DIRECTORY_SEPARATOR. '/storage/demo.csv');
// $stream = fopen($filePath, 'r'); // r : mode lecture seule
// echo fread($stream, 2);         //  on lit les (2) premiers octects.
// fclose($stream);


// fseek() : permet de lire un fichier et avancer le curseur en nombres d' octects.
// $filePath = realpath(__DIR__.DIRECTORY_SEPARATOR. '/storage/demo.csv');
// $stream = fopen($filePath, 'r'); // r : mode lecture seule
// echo fseek($stream, 2);         //  on lit les (2) premiers octects.
// fclose($stream);



// $filePath = realpath(__DIR__.DIRECTORY_SEPARATOR. '/storage/demo.csv');
// $stream   = fopen($filePath, 'r'); // r : mode lecture seule
// echo fstat($stream);                     //  on lit les (2) premiers octects.
// fclose($stream);
//print_r(fstat($stream));



// fgets() : permet de lire la premiere ligne mais il fait avancer le cursor a la ligne suivante
// $filePath = realpath(__DIR__.DIRECTORY_SEPARATOR. '/storage/demo.csv');
// $stream   = fopen($filePath, 'r'); // r : mode lecture seule
// echo fgets($stream);                     //  on lit les (2) premiers octects.
// fclose($stream);
// print_r(fgets($stream));


//const BREAKLINE = 1200;
//
//$filePath = realpath(__DIR__.DIRECTORY_SEPARATOR. '/storage/demo.csv');
//$stream   = fopen($filePath, 'r'); // lecture simple d' un fichier
//
//$k = 0;
//
//while ($line = fgets($stream)) {
//
//     $k++;
//
//     if ($k == 1200) { // 1200 - ieme ligne, on peut faire varier en fonction de la ligne dont on veut editer.
//         echo $line;
//         break;
//     }
//}
//
//fclose($stream);


$filePath = realpath(__DIR__.DIRECTORY_SEPARATOR. '/storage/demo.csv');
$stream   = fopen($filePath, 'r+'); // lecture et ecriture dans un fichier

$k = 0;

while ($line = fgets($stream)) {

    $k++;

    if ($k == 1200) { // 1200 - ieme ligne, on peut faire varier en fonction de la ligne dont on veut editer.
        fwrite($stream, 'Salut les gens');
        break;
    }
}

fclose($stream);


echo "\n";

// PHP Interactif:

// $ php -a

