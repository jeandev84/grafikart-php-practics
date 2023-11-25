<?php

// Foreach (signifit pour chaque)

/*
Tant que la condition n'est pas remplie on demandera toujours a l' utilisateur de rentrer une valeur

$chiffre = null;

while ($chiffre !== 10) {
    $chiffre = (int) readline("Entrez une heure : ");
}

echo "Bravo vous avez gagnez!\n";

=========================================================================
Sort de la boucle meme si la condition n' est pas remplit

$chiffre = null;


// Tant que la condition n'est pas remplie on demandera toujours a l' utilisateur de rentrer une valeur
while ($chiffre !== 10) {
    $chiffre = (int) readline("Entrez une heure : ");
    break;
}

echo "Bravo vous avez gagnez!\n";
*/


/*
$chiffre = null;

// increment de 1 en 1 ($i = $i + 1, $i += 1)
for($i = 0; $i < 10; $i++) {
   echo "- $i \n";
}


// increment de 2 en 2 ( $i = $i + 2)
for($i = 0; $i < 10; $i += 2) {
    echo "- $i \n";
}

*/


// Afficher les 3 premieres notes  d'un tableau par example
/*
$notes = [10, 15, 16, 17, 11, 9];

for($i = 0; $i < 3; $i++) {
    echo "- ". $notes[$i] . "\n";
}

function repurerNotes(int $nombres, array $notes) {
    for($i = 0; $i < $nombres; $i++) {
        echo "- ". $notes[$i] . "\n";
    }
}

recupererNotes(3, $notes);
*/

// Recommander dans notre cas d' utiliser foreach()
/*
$notes = [10, 15, 16, 17, 11, 9];

foreach ($notes as $note) {
     echo "- $note \n";
}
*/

$notes  = [10, 15, 16, 17, 11, 9];
$eleves = [
    'cm2' => 'Jean',
    'cm1' => 'Marc'
];


foreach ($eleves as $classe => $eleve) {
    echo "$eleve est dans la $classe \n";
}

echo "----------------------------------------\n";


$eleves = [
    'cm2' => ['Jean', 'Marc', 'Jane', 'Marion'],
    'cm1' => ['Emilie', 'Marcelin']
];


foreach ($eleves as $classe => $listEleves) {
    echo "La classe $classe\n";
    foreach ($listEleves as $eleve) {
        echo "- $eleve\n";
    }

    echo "\n";
}
/*
La classe CM2:
 - Jean
 - Marc
 - Jane
 - Marion

La classe CM1:
 - Emilie
 - Marcelin
*/