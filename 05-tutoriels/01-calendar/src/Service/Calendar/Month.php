<?php
declare(strict_types=1);

namespace App\Service\Calendar;

use DateTime;
use DateTimeImmutable;
use DateTimeInterface;
use Exception;

/**
 * Month
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package App\Service\Calendar
 *
 * @url http://localhost:8080/?month=4&year=2018
*/
class Month
{


    /**
     * @var array
    */
    public array $days = [
        'Lundi',
        'Mardi',
        'Mercredi',
        'Jeudi',
        'Vendredi',
        'Samedi',
        'Dimanche'
    ];


    /**
     * @var array|string[]
    */
    private array $months = [
        'Janvier',
        'Février',
        'Mars',
        'Avril',
        'Mai',
        'Juin',
        'Juillet',
        'Août',
        'Septembre',
        'Octobre',
        'Novembre',
        'Décembre'
    ];


    /**
     * @var int
    */
    public int $month;


    /**
     * @var int
    */
    public int $year;


    /**
     * @param int|null $month le mois compris entre 1 et 12
     * @param int|null $year l' annee
     * @throws Exception
    */
    public function __construct(?int $month = null, ?int $year = null)
    {
        if ($month === null || $month < 1 || $month > 12) {
           $month = intval(date('m'));
        }

        if ($year === null) {
            $year = intval(date('Y'));
        }

        /*
        if ($month < 1 || $month > 12) {
             throw new Exception("Le mois $month n' est pas valide");
        }
        if($year < 1970) {
            throw new Exception("L' annee est inferieur a 1970");
        }

        $month = $month % 12;
        */


        $this->month = $month;
        $this->year  = $year;
    }



    /**
     * Renvoie le premier jour du mois
     *
     * @return DateTimeInterface
    */
    public function getStartingDay(): DateTimeInterface
    {
        return new DateTimeImmutable("{$this->year}-{$this->month}-01");
    }




    /**
     * Recuperer le mois commencant par lundi
     *
     * @return DateTimeInterface
    */
    public function getStart(): DateTimeInterface
    {
        $start = $this->getStartingDay();

        return $start->format('N') === '1' ? $start : $start->modify('last monday');
    }





    /**
     * Retourne le mois en toute lettre
     *
     * @return string
    */
    public function toString(): string
    {
        return $this->months[$this->month - 1] .' '. $this->year;
    }



    /**
     * NumberOfWeeks
     *
     * Retourne le nombre de semaines pour 1 mois
     * Example: 5 weeks
     *
     * @return int
    */
    public function getWeeks(): int
    {
       $start     = $this->getStartingDay();
       $end       = $start->modify('+1 month -1 day');
       $startWeek = intval($start->format('W'));
       $endWeek   = intval($end->format('W'));

       if ($endWeek === 1) {
           $endWeek = intval($end->modify('- 7 days')->format('W')) + 1;
       }

       /* dump($endWeek); */

       $weeks = $endWeek - $startWeek + 1;

       if ($weeks < 0) {
           $weeks = intval($end->format('W'));
       }

       return $weeks;
    }


    /**
     * Determine si le jour est dans le mois en cours
     *
     * @param DateTimeInterface $date
     * @return bool
    */
    public function withInMonth(DateTimeInterface $date): bool
    {
        return $this->getStartingDay()->format('Y-m') === $date->format('Y-m');
    }





    /**
     * @return Month
     * @throws Exception
    */
    public function nextMonth(): Month
    {
        $month = $this->month + 1;
        $year  = $this->year;

        if ($month > 12) {
            $month  = 1;
            $year  += 1;
        }

        return new Month($month, $year);
    }




    /**
     * @return Month
     * @throws Exception
    */
    public function previousMonth(): Month
    {
        $month = $this->month - 1;
        $year  = $this->year;

        if ($month < 1) {
            $month  = 12;
            $year  -= 1;
        }

        return new Month($month, $year);
    }




    /**
     * @return string
     * @throws Exception
    */
    public function previousMonthLink(): string
    {
         return sprintf('?month=%s&year=%s', $this->previousMonth()->month, $this->previousMonth()->year);
    }


    /**
     * @return string
     * @throws Exception
    */
    public function nextMonthLink(): string
    {
        return sprintf('?month=%s&year=%s', $this->nextMonth()->month, $this->nextMonth()->year);
    }
}