<?php
declare(strict_types=1);

namespace Tests\Framework\Database;


use Framework\Database\Query;
use PHPUnit\Framework\TestCase;
use Tests\DatabaseTestCase;
use Tests\Framework\Database\Entity\Demo;


/**
 * Created by PhpStorm at 07.12.2023
 *
 * @QueryTest
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Tests\Framework\Database
 */
class QueryTest extends DatabaseTestCase
{

      public function testSimpleQuery()
      {
           $query = (new Query())->select('name')->from('posts');

           $this->assertEquals("SELECT name FROM posts", $query);
      }



    public function testWithWhere()
    {
        $query1 = (new Query())
                 ->from('posts', 'p')
                 ->where('a = :a OR b = :b', 'c = :c');


        $query2 = (new Query())
                  ->from('posts', 'p')
                  ->where('a = :a OR b = :b')
                  ->where('c = :c');

        $this->assertEquals("SELECT * FROM posts as p WHERE (a = :a OR b = :b) AND (c = :c)", $query1);
        $this->assertEquals("SELECT * FROM posts as p WHERE (a = :a OR b = :b) AND (c = :c)", $query2);
    }



    public function testFetchAll()
    {
        $pdo = $this->getPdo();
        $this->migrateDatabase($pdo);
        $this->seedDatabase($pdo);

        $posts = (new Query($pdo))->from('posts', 'p')->count();
        $this->assertEquals(105, $posts);

        $posts = (new Query($pdo))
                 ->from('posts', 'p')
                 ->where('p.id < :number')
                 ->params([
                     'number' => 30
                 ])
                 ->count();

        $this->assertEquals(29, $posts);
    }





    public function testHydrateEntity()
    {
        $pdo = $this->getPdo();
        $this->migrateDatabase($pdo);
        $this->seedDatabase($pdo);

        $posts = (new Query($pdo))
                 ->from('posts', 'p')
                 ->into(Demo::class)
                 ->fetchAll()
        ;

        $this->assertEquals('demo', substr($posts[0]->getSlug(), -4));
    }




    public function testLazyHydrate()
    {
        $pdo = $this->getPdo();
        $this->migrateDatabase($pdo);
        $this->seedDatabase($pdo);

        $posts = (new Query($pdo))
            ->from('posts', 'p')
            ->into(Demo::class)
            ->fetchAll();

        $post1 = $posts[0];
        $post2 = $posts[0];

        $this->assertSame($post1, $post2);
    }
}