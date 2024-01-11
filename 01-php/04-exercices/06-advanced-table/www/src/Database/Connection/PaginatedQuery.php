<?php
declare(strict_types=1);

namespace App\Database\Connection;


/**
 * Created by PhpStorm at 26.11.2023
 *
 * @PaginatedQuery
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Database\Connection
 */
class PaginatedQuery
{
      public function __construct(protected Query $query)
      {
      }


      public function paginate(int $page, int $limit)
      {

      }
}