<?php
declare(strict_types=1);

namespace Grafikart\Service\Calendar;

/**
 * Date
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Grafikart\Service\Calendar
*/
class Date
{

    /**
     * @var string
    */
    protected string $year;


    /**
     * @param string $year
    */
    public function __construct(string $year)
    {
        $this->year = $year;
    }



    /**
     * Returns an associative array like :
     * $date[Year][Month][Day] = DaysOfWeek
     *
     * @inheritDoc
    */
    public function getDates(): array
    {
        $dates = [];
        $date  = $this->convertYearToTimestamps();

        while (date('Y', $date) <= $this->year) {
            $year  = $this->getYear($date);
            $month = $this->getMonth($date);
            $day   = $this->getDay($date);
            $week  = $this->getDayOfWeek($date);
            $dates[$year][$month][$day] = $week;

            /*
            strtotime('2011-01-01 +1 DAY');
            strtotime('2011-01-01 +1 YEAR');
            strtotime('2011-01-01 -1 YEAR');
            $date  = $date + 24 * 3600;
            */
            
            $date  = strtotime(date('Y-m-d', $date) . ' +1 DAY');
        }

        return $dates;
    }



    /**
     * @return bool|int
    */
    private function convertYearToTimestamps(): bool|int
    {
        return strtotime($this->year .'-01-01');
    }


    /**
     * @param $timestamp
     * @return string
    */
    private function getYear($timestamp): string
    {
        return date('Y', $timestamp);
    }




    /**
     * @param $timestamp
     * @return string
    */
    private function getMonth($timestamp): string
    {
        return date('n', $timestamp);
    }




    /**
     * @param $timestamp
     * @return string
    */
    public function getDay($timestamp): string
    {
        return date('j', $timestamp);
    }


    /**
     * @param $timestamp
     * @return string
    */
    private function getDayOfWeek($timestamp): string
    {
        $week = date('w', $timestamp);

        // Dimanche en fin de semaine et non et debut de semaine
        return str_replace('0', '7', $week);
    }
}