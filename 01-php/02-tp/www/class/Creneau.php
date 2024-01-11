<?php


/**
 * @Creneau
 */
class Creneau
{

    /**
     * Heure de debut
    */
    public $debut;



    /**
     * Heure de fin
    */
    public $fin;


    /**
     * @param int $debut
     * @param int $fin
    */
    public function __construct(int $debut, int $fin)
    {
        $this->debut = $debut;
        $this->fin   = $fin;
    }



    /**
     * @return string
    */
    public function toHTML(): string {
        return "<strong>{$this->debut}h</strong> a <strong>{$this->fin}h</strong>\n";
    }





    /**
     * @param int $heure
     * @return bool
    */
    public function inclusHeure(int $heure): bool
    {
        return $heure >= $this->debut && $heure <= $this->fin;
    }



    /**
     * @param Creneau $creneau
     * @return bool
    */
    public function intersect(Creneau $creneau): bool
    {
         return $this->inclusHeure($creneau->debut) ||
                $this->inclusHeure($creneau->fin)   ||
                ($this->debut > $creneau->debut && $this->fin < $creneau->fin);
    }
}