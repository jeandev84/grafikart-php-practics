<?php

/**
 * Reponds a oui ou non
 *
 * @param string $phrase
 * @return bool
*/
function answerYesOrNo(string $phrase): bool {

    while (true) {
        $response = readline($phrase. " (o)ui/(n)on : \n");
        if ($response === 'o') {
            return true;
        } elseif ($response === 'n') {
            return false;
        }
    }

}


require_once 'functions_creneaux.php';