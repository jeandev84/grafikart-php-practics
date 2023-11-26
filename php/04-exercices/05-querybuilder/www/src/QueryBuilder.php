<?php
declare(strict_types=1);

namespace App;


use App\Database\Connection\PdoConnection;
use App\Database\Connection\QueryResult;

/**
 * Created by PhpStorm at 26.11.2023
 *
 * @QueryBuilder
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App
 *
 * TODO refactoring
*/
class QueryBuilder
{

     protected array $selects = [];
     protected array $from = [];
     protected array $orderBy = [];
     protected int $limit = 0;
     protected  int $offset = 0;
     protected array $wheres = [];
     protected array $parameters = [];

     protected PdoConnection $connection;


     public function __construct(PdoConnection $connection)
     {
         $this->connection = $connection;
     }



    public function select(string|array $selects): self
     {
         if (is_array($selects)) {
             $selects = join(', ', $selects);
         }

         return $this->addSelect($selects);
     }



     public function addSelect(string $select): self
     {
         $this->selects[] = $select;

         return $this;
     }


     public function from(string $table, string $alias = null): self
     {
          $this->from[$table] = ($alias ? "$table $alias" : $table);

          return $this;
     }



     public function orderBy(string $column, string $direction): self
     {
         $direction = strtoupper($direction);

         $this->orderBy[] = in_array($direction, ['ASC', 'DESC']) ? "$column $direction": $column;

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



     public function page(int $page, int $limit = 10): self
     {
         return $this->limit($limit)
                     ->offset($limit * ($page - 1));
     }




     public function where(string $condition): self
     {
         $this->wheres[] = $condition;

         return $this;
     }



     public function setParameters(string $name, $value): self
     {
         $this->parameters[$name] = $value;

         return $this;
     }



     public function getSQL(): string
     {
          $fields = join(", ", $this->selects);

          $sql[]  = "SELECT $fields FROM ". join(", ", $this->from);

          if ($this->wheres) {
              $sql[] = "WHERE ". join(' ', $this->wheres);
          }

          if ($this->orderBy) {
              $sql[] = "ORDER BY ". join(', ', $this->orderBy);
          }
          if ($this->limit) {
              $sql[] = "LIMIT $this->limit";
          }
          if ($this->offset) {
              $sql[] = "OFFSET $this->offset";
          }

          return join(" ", $sql);
     }


     /**
      * @return array
     */
     public function getParameters(): array
     {
         return $this->parameters;
     }



     /**
      * @return QueryResult
     */
     public function fetch(): QueryResult
     {
         $statement = $this->connection->statement($this->getSQL())
                                       ->setParameters($this->parameters);
         return $statement->fetch();
     }
}