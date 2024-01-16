<?php
declare(strict_types=1);

namespace Grafikart\Service\Calendar;

use DateTime;
use DateTimeInterface;
use Exception;
use Grafikart\Service\Calendar\Contract\CalendarInterface;

/**
 * Calendar
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Grafikart\Service\Calendar
*/
class Calendar implements CalendarInterface
{

    /**
     * @var string
    */
    protected string $year;


    /**
     * @var array
    */
    protected array $days  = [];


    /**
     * @var array
    */
    protected array $months = [];



    /**
     * @param string|null $year
    */
    public function __construct(string $year = null)
    {
        $this->year = $year ?: date('Y');
    }




    /**
     * @param array $days
     * @return $this
    */
    public function withDays(array $days): static
    {
        $this->days = $days;

        return $this;
    }




    /**
     * @inheritdoc
    */
    public function getDays(): array
    {
        return $this->days;
    }




    /**
     * @param $index
     * @param $default
     * @return string|null
     * @throws Exception
    */
    public function day($index, $default = null): ?string
    {
        return $this->days[$index] ?? $default;
    }



    /**
     * @param $index
     * @param $default
     * @return string|null
     * @throws Exception
     */
    public function month($index, $default = null): ?string
    {
        return $this->months[$index] ?? $default;
    }



    /**
     * @param array $months
     * @return $this
    */
    public function withMonths(array $months): static
    {
        $this->months = $months;

        return $this;
    }




    /**
     * @inheritdoc
    */
    public function getMonths(): array
    {
        return $this->months;
    }




    /**
     * @inheritdoc
    */
    public function getWeeks(): array
    {
        return [];
    }



    /**
     * @inheritDoc
    */
    public function getCurrentYear(): string
    {
        return $this->year;
    }


    /**
     * Returns current dates
     *
     * @return array
    */
    public function getCurrentDates(): array
    {
        return current($this->getAllDates());
    }


    /**
     * Returns an associative array like :
     * $date[Year][Month][Day] = DaysOfWeek
     *
     * @inheritDoc
    */
    public function getAllDates(): array
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