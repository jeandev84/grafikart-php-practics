<?php
declare(strict_types=1);

namespace Grafikart\Service\Calendar;

use DateTime;
use DateTimeInterface;
use Exception;
use Grafikart\Service\Calendar\Contract\DateInterface;

/**
 * Date
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Grafikart\Service\Calendar
*/
class Date implements DateInterface
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
        $date  = $this->fromDatetime();
        $dates = [];

        while ($date->format('Y') <= $this->year) {
            $year  = $date->format('Y');
            $month = $date->format('n');
            $day   = $date->format('j');
            $week  = str_replace('0', '7', $date->format('w'));
            $dates[$year][$month][$day] = $week;
            $date->add(new \DateInterval('P1D'));
        }

        return $dates;
    }




    /**
     * @inheritdoc
     * @throws Exception
    */
    public function getStartDate(): DateTimeInterface
    {
         return $this->fromDatetime();
    }




    /**
     * @return DateTime
     * @throws Exception
    */
    public function fromDatetime(): DateTime
    {
        return new DateTime($this->year .'-01-01');
    }




    /**
     * @return string
     *
     * @throws Exception
    */
    public function getYear(): string
    {
        return $this->getStartDate()->format('Y');
    }




    /**
     * @return string
     * @throws Exception
    */
    public function getMonth(): string
    {
        return $this->getStartDate()->format('n');
    }




    /**
     * @return string
     * @throws Exception
    */
    public function getDay(): string
    {
        return $this->getStartDate()->format('j');
    }




    /**
     * @return string
     * @throws Exception
    */
    public function getDayOfWeek(): string
    {
        $week = $this->getStartDate()->format('w');

        return str_replace('0', '7', $week);
    }
}