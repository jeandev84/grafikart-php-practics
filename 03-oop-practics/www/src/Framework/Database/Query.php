<?php
declare(strict_types=1);

namespace Framework\Database;


use Framework\Database\ORM\Exceptions\NoRecordException;
use Pagerfanta\Pagerfanta;

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

      /**
       * @var \PDO|null
      */
      protected ?\PDO $pdo;


      /**
       * @var array
      */
      protected array $selects = [];



      /**
       * @var array
      */
      protected array $from  = [];


      /**
       * @var array
      */
      protected array $joins  = [];


      /**
       * @var array
      */
      protected array $where   = [];




      /**
       * @var array
      */
      protected array $params = [];



      /**
       * @var array
      */
      protected array $groupBy = [];



      /**
       * @var array
      */
      protected array $orderBy = [];



      /**
       * @var mixed
      */
      protected $limit;




      /**
       * @var string|null
      */
      protected ?string $entity = null;



      /**
       * @param \PDO $pdo
      */
      public function __construct(\PDO $pdo)
      {
          $this->pdo = $pdo;
      }




      /**
        * @param string ...$fields
       *
        * @return $this
      */
      public function select(string ...$fields): self
      {
         $this->selects = $fields;

          return $this;
      }





      /**
       * @param string $table
       *
       * @param string $alias
       *
       * @return $this
      */
      public function from(string $table, string $alias = ''): self
      {
           if ($alias) {
               $this->from[$table] = $alias;
           } else {
               $this->from[] = [$table];
           }

           /* $this->from[$table] = ($alias ? "$table as $alias" : $table); */

           return $this;
      }




      /**
       * @param string $table
       *
       * @param string $condition
       *
       * @param string $type
       *
       * @return $this
      */
      public function join(string $table, string $condition, string $type = 'left'): self
      {
          $this->joins[$type][] = [$table, $condition];

          return $this;
      }






      /**
       * @param string ...$condition
       * @return $this
      */
      public function where(string ...$condition): self
      {
          $this->where = array_merge($this->where, $condition);

          return $this;
      }



      /**
       * @param int $length
       *
       * @param int $offset
       *
       * @return $this
      */
      public function limit(int $length, int $offset = 0): self
      {
          $this->limit  = "$offset, $length";

          return $this;
      }





      /**
       * @param string $order
       *
       * @return $this
      */
      public function orderBy(string $order): self
      {
          $this->orderBy[] = $order;

          return $this;
      }




      /**
       * @param array $params
       *
       * @return $this
      */
      public function params(array $params): self
      {
          $this->params = array_merge($this->params, $params);

          return $this;
      }




      /**
       * @param string|null $entity
       *
       * @return $this
      */
      public function into(?string $entity): self
      {
          $this->entity = $entity;

          return $this;
      }




      /**
       * @return mixed
      */
      public function fetch(): mixed
      {
          $record = $this->execute()->fetch(\PDO::FETCH_ASSOC);
          if($record === false) {
               return false;
          }
          if ($this->entity) {
              return Hydrator::hydrate($record, $this->entity);
          }
          return $record;
      }


     /**
      * @return mixed
      * @throws NoRecordException
     */
     public function fetchOrFail(): mixed
     {
        $record = $this->fetch();
        if ($record === false) {
            throw new NoRecordException();
        }
        return $record;
    }


     /**
      * @param int $perPage
      *
      * @param int $currentPage
      *
      * @return Pagerfanta
     */
    public function paginate(int $perPage, int $currentPage = 1): Pagerfanta
    {
        $paginator = new PaginatedQuery($this);

        return (new Pagerfanta($paginator))
               ->setMaxPerPage($perPage)
               ->setCurrentPage($currentPage);
    }




      /**
       * @return QueryResult
      */
      public function fetchAll(): QueryResult
      {
          return new QueryResult(
              $this->execute()->fetchAll(\PDO::FETCH_ASSOC),
              $this->entity
          );
      }






      /**
       * @return int
      */
      public function count(): int
      {
          $query = clone $this;
          $table = current($this->from);
          return $query->select("COUNT($table.id)")->execute()->fetchColumn();
      }





      private function execute(): \PDOStatement|false
      {
           $query = $this->__toString();

           if (!empty($this->params)) {
               $statement = $this->pdo->prepare($query);
               $statement->execute($this->params);
               return $statement;
           }

           return $this->pdo->query($query);
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
           $parts[] = $this->buildFrom($this->from);
           if (!empty($this->joins)) {
               foreach ($this->joins as $type => $joins) {
                   foreach ($joins as [$table, $condition]) {
                       $parts[] = strtoupper($type) . " JOIN $table ON $condition";
                   }
               }
           }
           if (!empty($this->where)) {
               $parts[] = "WHERE";
               $parts[] = "(" . join(") AND (", $this->where) . ")";
           }
           if (!empty($this->orderBy)) {
               $parts[] = "ORDER BY";
               $parts[] = join(", ", $this->orderBy);
           }

           if ($this->limit) {
               $parts[] = "LIMIT $this->limit";
           }

           return join(' ', $parts);
      }


      /**
       * @param array $tables
       * @return string
      */
      private function buildFrom(array $tables): string
      {
          $from = [];

          foreach ($tables as $key => $value) {
              if (is_string($key)) {
                  $from[] = "$key as $value";
              } else {
                  $from[] = $value;
              }
          }

          return join(', ', $from);
      }
}