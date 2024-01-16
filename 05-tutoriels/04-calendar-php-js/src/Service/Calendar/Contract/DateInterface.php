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
interface DateInterface
{


     /**
      * Returns start date as object
      *
      * @return DateTimeInterface
     */
     public function getStartDate(): DateTimeInterface;



     /**
      * Returns all dates
      *
      * @return array
     */
     public function getDates(): array;
}