<?php
declare(strict_types=1);

namespace Grafikart\Database\Connection;


/**
 * Created by PhpStorm at 25.11.2023
 *
 * @Query
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Grafikart\Database\Connection
 */
class Query implements QueryInterface
{

     protected \PDO $pdo;
     protected \PDOStatement $statement;
     protected array $parameters = [];


     public function __construct(\PDO $pdo)
     {
         $this->pdo = $pdo;
         $this->statement = new \PDOStatement();
     }





     public function prepare(string $sql): self
     {
         $this->statement = $this->pdo->prepare($sql);

         return $this;
     }



     public function query(string $sql): self
     {
         $this->statement = $this->pdo->query($sql);

         return $this;
     }



     public function setParameters(array $parameters): self
     {
         $this->parameters = $parameters;

         return $this;
     }



     public function map(string $classname): self
     {
         $this->statement->setFetchMode(\PDO::FETCH_CLASS, $classname);

         return $this;
     }



     public function execute(): bool
     {
         try {
             return $this->statement->execute($this->parameters);
         } catch (\PDOException $e) {
              # throw $e;
              throw new QueryException($e->getMessage());
         }
     }




     public function lastId(): int
     {
         return (int)$this->pdo->lastInsertId();
     }





     public function getSQL(): string
     {
         return $this->statement->queryString;
     }



     public function fetch(int $mode = 0): QueryResultInterface
     {
         $this->execute();

         return new QueryResult($this->statement, $mode);
     }



     public function exec(string $sql): mixed
     {

     }

    public function bindParam($name, $value, int $type): self
    {
        // TODO: Implement bindParam() method.
    }
}