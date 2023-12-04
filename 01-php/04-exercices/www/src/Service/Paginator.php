<?php
declare(strict_types=1);

namespace App\Service;


use App\Database\Connection\QueryBuilder;

/**
 * Created by PhpStorm at 26.11.2023
 *
 * @Paginator
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Service
*/
class Paginator
{

     protected QueryBuilder $qb;
     protected int $page;
     protected int $perPage;

     public function __construct(QueryBuilder $qb, int $page, int $perPage)
     {
         $this->qb      = $qb;
         $this->page    = $page;
         $this->perPage = $perPage;
     }




     public function getTotalPages()
     {
         return ceil($this->count() / $this->perPage);
     }



     public function count(): int
     {
         return count($this->getItems());
     }



     public function getItems(): array
     {
         $this->qb->limit($this->perPage)
                  ->offset($this->perPage * ($this->page - 1));

         return $this->qb->fetchAll();
     }



     public function getPage(): int
     {
         return $this->page;
     }
}