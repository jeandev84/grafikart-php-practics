<?php
declare(strict_types=1);

namespace Grafikart\Database\ORM\Persistence;


use Grafikart\Database\Connection\PdoConnection;
use Grafikart\Database\ORM\Persistence\Repository\EntityRepository;

/**
 * Created by PhpStorm at 28.11.2023
 *
 * @EntityManager
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Grafikart\Database\ORM\Persistence
 */
class EntityManager
{


      /**
       * @var PdoConnection
      */
      protected PdoConnection $connection;


      /**
       * @var EntityRepository[]
      */
      protected array $repositories = [];


      /**
       * @param PdoConnection $connection
      */
      public function __construct(PdoConnection $connection)
      {
          $this->connection = $connection;
      }





      public function find(string $classname, int $id)
      {

      }



      public function persist(object $object)
      {

      }



      public function remove(object $object)
      {

      }



      public function flush()
      {

      }
}