<?php
declare(strict_types=1);

namespace App\Database\Connection;


/**
 * Created by PhpStorm at 25.11.2023
 *
 * @Query
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Database\Connection
 */
class Query
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



     public function setParameters(array $parameters): self
     {
         $this->parameters = $parameters;

         return $this;
     }


     public function execute(): bool
     {
         try {

             if ($this->statement->execute($this->parameters)) {
                  return true;
             }

         } catch (\PDOException $e) {
              throw new QueryException($e->getMessage(), $e->getCode());
         }
         return false;
     }





     public function getSQL(): string
     {
         return $this->statement->queryString;
     }



     public function fetch(): QueryResult
     {
         $this->execute();

         return new QueryResult($this->statement);
     }
}