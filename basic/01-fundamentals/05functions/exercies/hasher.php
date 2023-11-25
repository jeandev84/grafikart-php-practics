<?php

/*

$mot = mb_strtolower(readline("Entrez un mot : "));

$palindrome = join(" ", array_reverse(explode(" ", $mot)));

<?php
$insultes = ['merde', 'con'];
$phrase = readline("Que voulez vous dire ?");

foreach($insultes as $insulte){
    $taille = strlen($insulte);
    $phrase = str_replace($insulte, str_repeat('*', $taille), $phrase);
}
echo $phrase;
*/



/*
$insultes = ['merde', 'con'];

$phrase = readline("Entrez une phrase : ");

foreach ($insultes as $insulte) {
    // $phrase   = str_replace($insulte, '***', $phrase);
    $replace  = str_repeat('*', strlen($insulte));
    $phrase   = str_replace($insulte, $replace, $phrase);
}

echo "$phrase \n";
*/


/*
$insultes = ['merde', 'con'];

$phrase = readline("Entrez une phrase : ");

$phrase = str_replace($insultes, ['*****', '***'], $phrase);

echo "$phrase\n";
*/


// Form simplifiee
/*
$insultes = ['merde', 'con'];
$asterisk = [];

foreach ($insultes as $insulte) {
    $asterisk[] = str_repeat('*', strlen($insulte));
}

$phrase = readline("Entrez une phrase : ");

$phrase = str_replace($insultes, $asterisk, $phrase);

echo "$phrase\n";

echo "=============================================\n";

*/

// Form simplifiee
$insultes = ['merde', 'con'];
$asterisk = [];

foreach ($insultes as $insulte) {
    // Trouver la premiere lettre du mot:
    // $lettre = substr($insulte, 0, 1);
    // Trouver la taille du (mot - 1)
    // Concatener la premiere lettre avec le str_repeat
    $asterisk[] = substr($insulte, 0, 1) . str_repeat('*', strlen($insulte) - 1);
}

$phrase = readline("Entrez une phrase : ");

$phrase = str_replace($insultes, $asterisk, $phrase);

echo "$phrase\n";

/*
Entrez une phrase : C'est un vrai bidon de merde avec ce nouveau mec de con qui n' avait meme pas penser.!
C'est un vrai bidon de m**** avec ce nouveau mec de c** qui n' avait meme pas penser.!
*/
