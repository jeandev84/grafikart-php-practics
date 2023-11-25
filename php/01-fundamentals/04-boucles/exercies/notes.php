<?php

/*
ALGORITHM

1. Demander a l' utilisateur  de rentrer une note ou taper "fin" s'il tape fin on ira a la suite
2. Chaque note est sauvegardee dans un tableau $notes (pensez a la syntax $notes[])
3. Si l' utilisateur tape fin on affiche le tableau des notes sous form de liste.
*/

/*
Resolution

// TANT QUE l' utilisateur ne tape pas fin.
    // On Ajoute la note tapez au tableau des notes
// POUR CHAQUE note DANS notes
    // ON AFFICHE "- note"
*/

$notes = [];

$action = null;

// TANT QUE l' utilisateur ne tape pas fin.
while ($action !== "fin") {

    $action  = readline('Entrez une nouvelle note (ou "fin" pour terminer la saisie) : ');

    // On Ajoute la note tapez au tableau des notes
    if ($action !== "fin") {
        $notes[] = (int) $action;
    }
}

// POUR CHAQUE note DANS notes

echo "List des notes : \n";
foreach ($notes as $note) {
    // ON AFFICHE "- note"
    echo "- $note\n";
}



// AMELIORATION DU CODE

$notes = [];

// TANT QUE l' utilisateur ne tape pas fin.
while (true) {

    $action  = readline('Entrez une nouvelle note (ou "fin" pour terminer la saisie) : ');

    // On Ajoute la note tapez au tableau des notes
    if ($action === "fin") {
        break;
    } else {
        $notes[] = (int) $action;
    }
}

// POUR CHAQUE note DANS notes

echo "List des notes : \n";
foreach ($notes as $note) {
    // ON AFFICHE "- note"
    echo "- $note\n";
}