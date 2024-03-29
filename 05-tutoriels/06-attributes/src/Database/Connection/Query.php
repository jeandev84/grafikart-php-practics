<?php
declare(strict_types=1);

namespace Grafikart\Database\Connection;

use Grafikart\Database\Connection\Exception\QueryException;
use PDO;
use PDOException;
use PDOStatement;

/**
 * Query
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Grafikart\Database\Connection
 */
class Query
{

      /**
       * @var PDO
      */
      protected PDO $pdo;


      /**
       * @var PDOStatement
      */
      protected PDOStatement $statement;


      /**
       * @var string
      */
      protected string $classMapping;



      /**
       * @var array
      */
      protected array $params = [];



      /**
       * @var array
      */
      protected array $types = [
          0 => PDO::PARAM_NULL,
          1 => PDO::PARAM_STR,
          2 => PDO::PARAM_INT,
          3 => PDO::PARAM_BOOL
     ];



      /**
       * @param PDO $pdo
      */
      public function __construct(PDO $pdo)
      {
          $this->pdo       = $pdo;
          $this->statement = new PDOStatement();
      }




      /**
       * @param string $sql
       * @return $this
      */
      public function prepare(string $sql): static
      {
          $this->statement = $this->pdo->prepare($sql);

          return $this;
      }


      /**
       * @param string $sql
       * @return $this
       */
      public function query(string $sql): static
      {
          $this->statement = $this->pdo->query($sql);

          return $this;
      }




      /**
       * @param string $class
       * @return $this
      */
      public function map(string $class): static
      {
          if ($class !== '') {
              $this->statement->setFetchMode(PDO::FETCH_CLASS, $class);
              $this->classMapping = $class;
          }


          return $this;
      }


      /**
       * @param $key
       * @param $value
       * @param int $type
       * @return $this
      * @throws QueryException
      */
      public function bindParam($key, $value, int $type = 0): static
      {
          if (! isset($this->types[$type])) {
               throw new QueryException("Could not resolve binding type ($type)");
          }

          $this->statement->bindParam($key, $value, $this->types[$type]);

          return $this;
      }




    /**
     * @param $key
     * @param $value
     * @param int $type
     * @return $this
     * @throws QueryException
     */
    public function bindValue($key, $value, int $type = 0): static
    {
        if (! isset($this->types[$type])) {
            throw new QueryException("Could not resolve type binding type ($type)");
        }

        $this->statement->bindValue($key, $value, $this->types[$type]);

        return $this;
    }





    /**
     * @param $key
     * @param $value
     * @param int $type
     * @return $this
     * @throws QueryException
    */
     public function bindColumn($key, $value, int $type = 0): static
     {
         if (! isset($this->types[$type])) {
            throw new QueryException("Could not resolve binding type ($type)");
         }

         $this->statement->bindColumn($key, $value, $this->types[$type]);

         return $this;
     }





      /**
       * @param array $params
       * @return $this
      */
      public function withParams(array $params): static
      {
          $this->params = $params;

          return $this;
      }




      /**
       * @return bool
       * @throws QueryException
      */
      public function execute(): bool
      {
          try {
              return $this->statement->execute($this->params);
          } catch (PDOException $e) {
              throw new QueryException("{$this->getSQL()}. {$e->getMessage()}");
          }
      }



    /**
     * @param string $sql
     * @return bool
    */
    public function exec(string $sql): bool
    {
        try {
            return boolval($this->pdo->exec($sql));
        } catch (PDOException $e) {
            throw new QueryException($e->getMessage());
        }
    }




      /**
       * @return Result
      */
      public function fetch(): Result
      {
           $this->execute();

           return new Result($this->statement);
      }




      /**
       * @return int
      */
      public function lastId(): int
      {
          return intval($this->pdo->lastInsertId());
      }




      /**
       * @return string
      */
      public function getSQL(): string
      {
           return $this->statement->queryString;
      }


     /**
      * @return string
     */
     public function getClassMapping(): string
     {
        return $this->classMapping;
     }


    /**
     * @return array
    */
    public function getParams(): array
    {
        return $this->params;
    }



    /**
     * @return PDO
    */
    public function getPdo(): PDO
    {
        return $this->pdo;
    }



    /**
     * @return PDOStatement
    */
    public function getStatement(): PDOStatement
    {
        return $this->statement;
    }


    /**
     * @return array
    */
    public function getTypes(): array
    {
        return $this->types;
    }
}