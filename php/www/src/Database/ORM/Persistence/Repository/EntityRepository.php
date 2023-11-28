<?php
declare(strict_types=1);

namespace Grafikart\Database\ORM\Persistence\Repository;


use Exception;
use Grafikart\Database\Connection\PdoConnection;
use Grafikart\Database\ORM\Persistence\Repository\Exception\NotFoundException;

/**
 * Created by PhpStorm at 28.11.2023
 *
 * @EntityRepository
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Grafikart\Database\ORM\Persistence\Repository
 */
class EntityRepository implements EntityRepositoryIInterface
{

     protected PdoConnection $connection;
     protected string $classname;
     protected string $tableName = '';

     public function __construct(PdoConnection $connection, string $classname)
     {
         if (! $this->tableName) {
              throw new Exception("Could not found table name in [ ". get_called_class() . "]");
         }

         if (! $classname) {
             throw new Exception("Could not found class name in [ ". get_called_class() . "]");
         }

         $this->connection = $connection;
         $this->classname  = $classname;
     }



    public function find(int $id): mixed
    {
        $result = $this->connection
                        ->statement("SELECT * FROM {$this->tableName} WHERE id = :id")
                        ->setParameters(compact('id'))
                        ->map($this->classname)
                        ->fetch()
                        ->one();

        if ($result === false) {
            throw new NotFoundException($this->tableName, $id);
        }

        return $result;
    }



    public function findAll(): array
    {
        return $this->connection
                   ->statement("SELECT * FROM {$this->tableName}")
                   ->map($this->classname)
                   ->fetch()
                   ->all();
    }





    public function getClassName(): string
    {
       return $this->classname;
    }
}