<?php


/**
 * @Compteur
*/
class Compteur
{


    const INCREMENT = 1;


    /**
     * Fichier compteur
     *
     * @var string
    */
    protected $fichier;




    /**
     * Compteur constructor.
     *
     * @param string $fichier
    */
    public function __construct(string $fichier)
    {
        $this->fichier = $fichier;
    }


    /**
     * @return void
    */
    public function incrementerNombreVues()
    {
        $compteur = 1;

        if (file_exists($this->fichier)) {
            $compteur = (int)file_get_contents($this->fichier);
            $compteur += static::INCREMENT;
        }

        file_put_contents($this->fichier, $compteur);
    }




    /**
     * @return int
    */
    public function recupererNombreVues(): int
    {
        if (! file_exists($this->fichier)) {
            return 0;
        }

        return file_get_contents($this->fichier);
    }
}