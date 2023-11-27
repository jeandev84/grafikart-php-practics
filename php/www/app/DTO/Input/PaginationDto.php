<?php
declare(strict_types=1);

namespace App\DTO\Input;


/**
 * Created by PhpStorm at 27.11.2023
 *
 * @PaginationDto
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\DTO\Input
 */
class PaginationDto
{
     /**
      * Current page
      *
      * @var int
     */
      public int $page;


      /**
       * Number of records per page (perPage)
       *
       * @var int
      */
      protected int $limit;


      /**
       * Offset records
       *
       * @var int
      */
      protected int $offset = 0;


      public function __construct(int $page, int $limit)
      {
          $this->page   = $page;
          $this->limit  = $limit;
          # $this->offset = $limit * ($page - 1);
      }


      public function getPage(): int
      {
          return $this->page;
      }



      public function getLimit(): int
      {
          return $this->limit;
      }



      public function getOffSet(): int
      {
           # items : 50
           # totalPage: 5
           # si on a limit = 12
           # si on est a la page 1 : LIMIT 12 OFFSET 0  (12 * (1-1) = 12 * 0) [ items: 12 ]
           # si on est a la page 2 : LIMIT 12 OFFSET 12 (12 * (2-1) = 12 * 1) [ items: 12 ]
           # si on est a la page 3 : LIMIT 12 OFFSET 24 (12 * (3-1) = 12 * 2) [ items: 12 ]
           # si on est a la page 4 : LIMIT 12 OFFSET 36 (12 * (4-1) = 12 * 3) [ items: 12 ]
           # si on est a la page 3 : LIMIT 12 OFFSET 48 (12 * (5-1) = 12 * 4) [ items: 2  ]
           return $this->limit * ($this->page - 1);
      }
}