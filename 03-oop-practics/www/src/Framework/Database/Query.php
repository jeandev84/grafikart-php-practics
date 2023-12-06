<?php
declare(strict_types=1);

namespace Framework\Database;


/**
 * Created by PhpStorm at 07.12.2023
 *
 * @Query
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Framework\Database
 */
class Query
{

      protected array $selects = [];
      protected string $from   = "";
      protected array $where   = [];
      protected array $group   = [];
      protected array $order   = [];
      protected int  $limit    = 0;
      protected int  $offset   = 0;


      public function select(string ...$fields): self
      {
         $this->selects = $fields;

          return $this;
      }


      public function from(string $table, string $alias = ''): self
      {
           $this->from = $table;

           return $this;
      }



      public function where(string ...$conditions): self
      {
          $this->where = $conditions;

          return $this;
      }




      public function __toString(): string
      {
           $parts = ['SELECT'];

           if ($this->selects) {
               $parts[] = join(', ', $this->selects);
           } else {
               $parts[] = "*";
           }

           $parts[] = 'FROM';
           $parts[] = $this->from;

           if ($this->where) {
               $parts[] = "WHERE";
               $parts[] = "(" . join(") AND (", $this->where) . ")";
           }

           return join(' ', $parts);
      }

}