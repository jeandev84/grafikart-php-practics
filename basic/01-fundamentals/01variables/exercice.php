<?php

/*
Exercise 1:

Afficher : Bonjour Marc Doe Afficher vous avez eu 15 de moyennes
*/

$prenom = 'Marc';
$nom    = 'Doe';
$note1  = 10;
$note2  = 20;

$moyenne = ($note1 + $note2) / 2;

echo 'Bonjour '. $prenom . ' '. $nom . ' vous avez eu '. (($note1 + $note2) / 2) . ' de moyenne'. "\n";
echo "Bonjour $prenom $nom vous avez eu {$moyenne} de moyennes.\n";




