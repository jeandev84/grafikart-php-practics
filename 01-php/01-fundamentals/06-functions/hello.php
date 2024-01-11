<?php

/*
function hello($nom = "Guest") {
    return "Bonjour, $nom\n";
}


$salutation = hello();
echo "$salutation \n";

$salutation = hello('Marc');
echo $salutation;

*/

/*
function hello($nom = null) {

    if ($nom === null) {
         return "Bonjour\n";
    }

    return "Bonjour, $nom\n";
}
*/


$nom      = "Doe";
$question = 'Avez vous dinez ? ';

function hello($prenom = null, $nom = null) {

    global $question;

    if ($prenom === null) {
        return "Bonjour\n";
    }

    return "Bonjour, $prenom $nom $question\n";
}