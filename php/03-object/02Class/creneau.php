<?php

require __DIR__. DIRECTORY_SEPARATOR .'Creneau.php';

$creneau1 = new Creneau(9, 12);
$creneau2 = new Creneau(14, 16);

/*
var_dump(
    $creneau1->inclusHeure(10),
    $creneau2->inclusHeure(10),
    $creneau1->intersect($creneau2)
);
*/

echo $creneau1->toHTML();



