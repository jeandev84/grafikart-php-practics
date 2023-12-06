<?php
declare(strict_types=1);

namespace Tests\Framework\Database;


use Framework\Database\ORM\EntityRepository;
use PDO;
use PHPUnit\Framework\TestCase;

/**
 * Created by PhpStorm at 06.12.2023
 *
 * @EntityRepositoryTest
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Tests\Framework\Database
 */
class EntityRepositoryTest extends TestCase
{

      protected EntityRepository $repository;


      public function setUp(): void
      {
          $pdo = new PDO('sqlite::memory:', null, null, [
              PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
              PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
          ]);

          $pdo->exec('CREATE TABLE test (id INTEGER PRIMARY KEY AUTOINCREMENT, name varchar(255))');

          $this->repository = new EntityRepository($pdo, '', 'test');

          /*
          Assigner une valeur au champs "table" dans EntityRepository
          $reflection = new \ReflectionClass($this->repository);
          $property   = $reflection->getProperty('table');
          $property->setValue($this->repository, 'test');
          */

      }



      public function testFind()
      {
          $this->repository->getConnection()->exec('INSERT INTO test (name) VALUES ("a1")');
          $this->repository->getConnection()->exec('INSERT INTO test (name) VALUES ("a2")');
          $test = $this->repository->find(1);
          $this->assertInstanceOf(\stdClass::class, $test);
          $this->assertEquals('a1', $test->name);
      }




      public function testFindList()
      {
          $this->repository->getConnection()->exec('INSERT INTO test (name) VALUES ("a1")');
          $this->repository->getConnection()->exec('INSERT INTO test (name) VALUES ("a2")');
          $this->assertEquals(['1' => 'a1', '2' => 'a2'], $this->repository->findList());
      }
}