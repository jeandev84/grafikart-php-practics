<?php
declare(strict_types=1);

namespace Grafikart\Database\Builder\SQL\DQL;


use Grafikart\Database\Builder\SQL\Builder;

/**
 * Created by PhpStorm at 28.11.2023
 *
 * @Select
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Grafikart\Database\Builder\SQL\DQL
 */
class Select extends Builder
{

      protected array $selects = [];
      protected array $from = [];
      protected array $joins = [];
      protected array $groupBy = [];
      protected array $having  = [];
      protected array $orderBy = [];
      protected int $limit  = 0;
      protected int $offset = 0;



      public function select(string $selects): self
      {
           return $this->addSelect($selects);
      }



      public function addSelect(string $selects): self
      {
          $this->selects[] = $selects;

          return $this;
      }

      public function from(string $table, string $alias = ''): self
      {
            $this->from[$table] = ($alias ? "$table $alias" : $table);

            return $this;
      }




      public function addJoin(string $join): self
      {
          $this->joins[] = $join;

          return $this;
      }



      public function join(string $table, string $condition): self
      {
           return $this->addJoin("JOIN $table ON $condition");
      }



      public function leftJoin(string $table, string $condition): self
      {
          return $this->addJoin("LEFT JOIN $table ON $condition");
      }



    public function rightJoin(string $table, string $condition): self
    {
        return $this->addJoin("RIGHT JOIN $table ON $condition");
    }




    public function innerJoin(string $table, string $condition): self
    {
        return $this->addJoin("INNER JOIN $table ON $condition");
    }




    public function fullJoin(string $table, string $condition): self
    {
        return $this->addJoin("FULL JOIN $table ON $condition");
    }





      public function groupBy(string $groupBy): self
      {
          $this->groupBy[] = $groupBy;

          return $this;
      }



      public function having(string $having): self
      {
          $this->having[] = $having;

          return $this;
      }




      public function orderBy(string $column, string $direction = 'asc'): self
      {
            $this->orderBy[] = "$column $direction";

            return $this;
      }



      public function limit(int $limit): self
      {
           $this->limit = $limit;

           return $this;
      }



      public function offset(int $offset): self
      {
          $this->offset = $offset;

          return $this;
      }



     public function getSQL(): string
     {
        // TODO: Implement getSQL() method.
     }
}