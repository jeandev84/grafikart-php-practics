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
 *
 * ./vendor/bin/phpunit tests/Framework/Database/EntityRepositoryTest --colors
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
          $this->repository->getPdo()->exec('INSERT INTO test (name) VALUES ("a1")');
          $this->repository->getPdo()->exec('INSERT INTO test (name) VALUES ("a2")');
          $test = $this->repository->find(1);
          $this->assertInstanceOf(\stdClass::class, $test);
          $this->assertEquals('a1', $test->name);
      }




      public function testFindList()
      {
          $this->repository->getPdo()->exec('INSERT INTO test (name) VALUES ("a1")');
          $this->repository->getPdo()->exec('INSERT INTO test (name) VALUES ("a2")');
          $this->assertEquals(['1' => 'a1', '2' => 'a2'], $this->repository->findList());
      }




    public function testFindAll()
    {
        $this->repository->getPdo()->exec('INSERT INTO test (name) VALUES ("a1")');
        $this->repository->getPdo()->exec('INSERT INTO test (name) VALUES ("a2")');
        $categories = $this->repository->findAll();
        $this->assertCount(2, $categories);
        $this->assertInstanceOf(\stdClass::class, $categories[0]);
        $this->assertEquals('a1', $categories[0]->name);
        $this->assertEquals('a2', $categories[1]->name);
    }




    public function testFindBy()
    {
        $this->repository->getPdo()->exec('INSERT INTO test (name) VALUES ("a1")');
        $this->repository->getPdo()->exec('INSERT INTO test (name) VALUES ("a2")');
        $this->repository->getPdo()->exec('INSERT INTO test (name) VALUES ("a1")');
        $category = $this->repository->findBy('name', 'a1');
        $this->assertInstanceOf(\stdClass::class, $category);
        $this->assertEquals('1', (int)$category->id);
    }


    public function testExists()
    {
        $this->repository->getPdo()->exec('INSERT INTO test (name) VALUES ("a1")');
        $this->repository->getPdo()->exec('INSERT INTO test (name) VALUES ("a2")');
        $this->assertTrue($this->repository->exists(1));
        $this->assertTrue($this->repository->exists(2));
        $this->assertFalse($this->repository->exists(3123));
    }
}