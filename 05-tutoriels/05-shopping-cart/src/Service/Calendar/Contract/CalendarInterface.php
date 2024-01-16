<?php
declare(strict_types=1);

namespace Grafikart\Service\Calendar\Contract;


use DateTimeInterface;

/**
 * DateInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Grafikart\Service\Calendar\Contract
 */
interface CalendarInterface
{


     /**
      * Returns start date as object
      *
      * @return DateTimeInterface
     */
     public function getStartDate(): DateTimeInterface;




     /**
      * Returns curren year
      *
      * @return string
     */
     public function getCurrentYear(): string;




     /**
      * Returns current dates
      *
      * @return array
     */
     public function getCurrentDates(): array;




     /**
      * Returns week days
      *
      * @return array
     */
     public function getDays(): array;




     /**
      * Returns year months
      *
      * @return array
     */
     public function getMonths(): array;



     /**
      * Returns year weeks
      *
      * @return array
     */
     public function getWeeks(): array;




     /**
      * Returns all dates
      *
      * @return array
     */
     public function getAllDates(): array;
}