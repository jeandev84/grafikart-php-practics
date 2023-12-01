<?php
declare(strict_types=1);

namespace Grafikart\Database\Connection;


use PDO;
use PDOException;

/**
 * Created by PhpStorm at 25.11.2023
 *
 * @PdoConnection
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Grafikart\Database\Connection
 */
class PdoConnection
{

     protected array $options = [
         PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
         PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
     ];


     protected $pdo;


     public function __construct(string $dsn, string $username = null, string $password = null, array $options = [])
     {
         try {
             $this->pdo = new PDO($dsn, $username, $password, array_merge($this->options, $options));
         } catch (PDOException $e) {
             throw new ConnectionException($e->getMessage(), $e->getCode());
         }
     }



     /**
      * @return bool
     */
     public function connected(): bool
     {
         return $this->pdo instanceof PDO;
     }




     public function disconnect(): void
     {
         $this->pdo = null;
     }




    /**
     * @return PDO
    */
    public function getPdo(): PDO
    {
        return $this->pdo;
    }




    public function statement(string $sql): Query
    {
         $statement = new Query($this->getPdo());
         return $statement->prepare($sql);
    }



    public function query(string $sql): Query
    {
        $query = new Query($this->getPdo());

        return $query->query($sql);
    }



    public function lastInsertId(): int
    {
         return (int)$this->pdo->lastInsertId();
    }


    public function executeQuery(string $sql): mixed
    {
        return $this->pdo->exec($sql);
    }
}