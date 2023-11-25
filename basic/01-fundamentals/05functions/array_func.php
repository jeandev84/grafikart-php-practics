<?php

// array_push() ajoute des elements dans un tableau
echo "Print notes\n";
$notes   = [10, 20, 13];
$notes[] = 16;
array_push($notes, 9, 17);
print_r($notes);

// Renverse l'ordre d'un tableau sans modifier les cles
echo "Reversed notes \n";
$notes   = [10, 20, 13];
$noteReversed = array_reverse($notes);
print_r($notes);
print_r($noteReversed);

// Range un tableau du plus petit au plus grand
echo "Sort notes (range by  asc) \n";
$notes = [10, 20, 13, 9.7, 11];
sort($notes);
print_r($notes);