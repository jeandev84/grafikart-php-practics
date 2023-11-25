<?php
require_once __DIR__.DIRECTORY_SEPARATOR.'Compteur.php';


/**
 * @DoubleCompteur
*/
class DoubleCompteur extends Compteur
{


    const INCREMENT = 10;


    /**
     * @return int
    */
    /*
    public function recupererNombreVues(): int
    {
        return 2 * parent::recupererNombreVues();
    }
    */
}