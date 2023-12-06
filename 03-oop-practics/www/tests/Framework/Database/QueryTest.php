<?php
declare(strict_types=1);

namespace Tests\Framework\Database;


use Framework\Database\Query;
use PHPUnit\Framework\TestCase;

/**
 * Created by PhpStorm at 07.12.2023
 *
 * @QueryTest
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Tests\Framework\Database
 */
class QueryTest extends TestCase
{

      public function testSimpleQuery()
      {
           $query = (new Query())->select('name')->from('posts');

           $this->assertEquals("SELECT name FROM posts", $query);
      }



    public function testWithWhere()
    {
        $query = (new Query())
                 ->from('posts', 'p')
                 ->where('a = :a OR b = :b', 'c = :c');

        $this->assertEquals("SELECT * FROM posts as p WHERE (a = :a OR b = :b) AND (c = :c)", $query);
    }
}