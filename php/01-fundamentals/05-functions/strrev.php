<?php

// Functions


/*
$variable = readline();
$debug = print_r($variable, true);
var_dump($variable);
var_export($variable);
*/

// On recupere le mot (examples kayak)
$mot = readline("Veuillez entrer un mot : ");

// Recupere le mot inverse (strrev : string reverse)
$reverse = strtolower(strrev($mot));

if (strtolower($mot) === $reverse) {
    echo "Ce mot est un palyndrome";
} else {
    echo "Ce mot n'est pas un palyndrome";
}

echo "\n";
