<?php


$filePath = realpath(__DIR__.DIRECTORY_SEPARATOR. '/storage/demo.csv');
$stream   = fopen($filePath, 'r+');

$k = 0;

while ($line = fgets($stream)) {

     $k++;

     if ($k == 1200) {
         fwrite($stream, 'Salut les gens');
         break;
     }
}

fclose($stream);


echo "\n";

// PHP Interactif:

// $ php -a

