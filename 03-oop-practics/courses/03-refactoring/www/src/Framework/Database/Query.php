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

      protected ?\PDO $pdo;

      protected array $selects = [];
      protected array $from    = [];
      protected array $where   = [];
      protected array $params = [];
      protected array $groupBy = [];
      protected array $orderBy = [];
      protected int   $limit   = 0;
      protected int   $offset  = 0;
      protected ?string $entity = null;


      /**
       * @param \PDO $pdo
      */
      public function __construct(?\PDO $pdo = null)
      {
          $this->pdo = $pdo;
      }



      public function select(string ...$fields): self
      {
         $this->selects = $fields;

          return $this;
      }



      public function from(string $table, string $alias = ''): self
      {
           $this->from[$table] = ($alias ? "$table as $alias" : $table);

           return $this;
      }



      public function where(string ...$condition): self
      {
          $this->where = array_merge($this->where, $condition);

          return $this;
      }


      public function params(array $params): self
      {
          $this->params = array_merge($this->params, $params);

          return $this;
      }



      public function into(string $entity): self
      {
          $this->entity = $entity;

          return $this;
      }



      public function all(): QueryResult
      {
          return new QueryResult(
              $this->execute()->fetchAll(\PDO::FETCH_ASSOC),
              $this->entity
          );
      }




      public function count(): int
      {
          $this->select("COUNT(id)");
          return $this->execute()->fetchColumn();
      }


      private function execute(): \PDOStatement|false
      {
           $query = $this->__toString();
           if ($this->params) {
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
           $parts[] = join(', ', array_values($this->from));

           if (!empty($this->where)) {
               $parts[] = "WHERE";
               $parts[] = "(" . join(") AND (", $this->where) . ")";
           }

           return join(' ', $parts);
      }

}