<?php
declare(strict_types=1);

namespace Grafikart\Database\ORM\Persistence\Repository;


use Grafikart\Database\Connection\PdoConnection;

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

     public function __construct(PdoConnection $connection, string $classname)
     {
         $this->connection = $connection;
         $this->classname  = $classname;
     }


    public function find(int $id): mixed
    {
        // TODO: Implement find() method.
    }



    public function findAll(): array
    {
        // TODO: Implement findAll() method.
    }

    public function getClassName(): string
    {
       return $this->classname;
    }
}