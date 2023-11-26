<?php

use App\Database\Connection\QueryBuilder;
use PHPUnit\Framework\TestCase;

final class QueryBuilderTest extends TestCase
{

    public function createQueryBuilder(): QueryBuilder
    {
        $pdo = new PDO("sqlite::memory:");
        $pdo->query('CREATE TABLE products (
    id INTEGER CONSTRAINT products_pk primary key autoincrement,
    name TEXT,
    address TEXT,
    city TEXT)');
        for ($i = 1; $i <= 10; $i++) {
            $pdo->exec("INSERT INTO products (name, address, city) VALUES ('Product $i', 'Addresse $i', 'Ville $i');");
        }

        return new QueryBuilder($pdo);
    }


    public function testSimpleQuery()
    {
        $q = $this->createQueryBuilder()->from("users", "u")->toSQL();
        $this->assertEquals("SELECT * FROM users u", $q);
    }

    public function testOrderBy()
    {
        $q = $this->createQueryBuilder()->from("users", "u")->orderBy("id", "DESC")->toSQL();
        $this->assertEquals("SELECT * FROM users u ORDER BY id DESC", $q);
    }

    public function testMultipleOrderBy()
    {
        $q = $this->createQueryBuilder()
            ->from("users")
            ->orderBy("id", "ezaearz")
            ->orderBy("name", "desc")
            ->toSQL();
        $this->assertEquals("SELECT * FROM users ORDER BY id, name DESC", $q);
    }

    public function testLimit()
    {
        $q = $this->createQueryBuilder()
            ->from("users")
            ->limit(10)
            ->orderBy("id", "DESC")
            ->toSQL();
        $this->assertEquals("SELECT * FROM users ORDER BY id DESC LIMIT 10", $q);
    }

    public function testOffset()
    {
        $q = $this->createQueryBuilder()
            ->from("users")
            ->limit(10)
            ->offset(3)
            ->orderBy("id", "DESC")
            ->toSQL();
        $this->assertEquals("SELECT * FROM users ORDER BY id DESC LIMIT 10 OFFSET 3", $q);
    }



    public function testOffsetWithoutLimit()
    {
        $this->expectException(Exception::class);
        $q = $this->createQueryBuilder()
            ->from("users")
            ->offset(3)
            ->orderBy("id", "DESC")
            ->toSQL();
        $this->assertEquals("SELECT * FROM users ORDER BY id DESC LIMIT 10 OFFSET 3", $q);
    }


    public function testPage()
    {
        $q = $this->createQueryBuilder()
            ->from("users")
            ->limit(10)
            ->page(3)
            ->orderBy("id", "DESC")
            ->toSQL();
        $this->assertEquals("SELECT * FROM users ORDER BY id DESC LIMIT 10 OFFSET 20", $q);
        $q = $this->createQueryBuilder()
            ->from("users")
            ->limit(10)
            ->page(1)
            ->orderBy("id", "DESC")
            ->toSQL();
        $this->assertEquals("SELECT * FROM users ORDER BY id DESC LIMIT 10 OFFSET 0", $q);
    }

    public function testCondition()
    {
        $q = $this->createQueryBuilder()
            ->from("users")
            ->where("id > :id")
            ->setParam("id", 3)
            ->limit(10)
            ->orderBy("id", "DESC")
            ->toSQL();
        $this->assertEquals("SELECT * FROM users WHERE id > :id ORDER BY id DESC LIMIT 10", $q);
    }

    public function testSelect()
    {
        $q = $this->createQueryBuilder()
            ->select("id", "name", "product")
            ->from("users");
        $this->assertEquals("SELECT id, name, product FROM users", $q->toSQL());
    }

    public function testSelectMultiple()
    {
        $q = $this->createQueryBuilder()
            ->select("id", "name")
            ->from("users")
            ->select('product');
        $this->assertEquals("SELECT id, name, product FROM users", $q->toSQL());
    }

    public function testSelectAsArray()
    {
        $q = $this->createQueryBuilder()
            ->select(["id", "name", "product"])
            ->from("users");
        $this->assertEquals("SELECT id, name, product FROM users", $q->toSQL());
    }

    public function testFetch()
    {
        $city = $this->createQueryBuilder()
            ->from("products")
            ->where("name = :name")
            ->setParam("name", "Product 1")
            ->fetch("city");
        $this->assertEquals("Ville 1", $city);
    }



    public function testFetchAll()
    {
        $products = $this->createQueryBuilder()
                    ->from("products")
                    ->where("name = :name")
                    ->setParam("name", "Product 1")
                    ->fetchAll();

        $this->assertEquals("Ville 1", $products[0]['city']);
    }




    public function testFetchAllWithNoData()
    {
        $products = $this->createQueryBuilder()
            ->from("products")
            ->where("name = :name")
            ->setParam("name", "azeazeaze")
            ->fetchAll();

        $this->assertEmpty($products);
    }

    public function testFetchWithInvalidRow()
    {
        $city = $this->createQueryBuilder()
            ->from("products")
            ->where("name = :name")
            ->setParam("name", "azezaeeazazzaez")
            ->fetch("city");
        $this->assertNull($city);
    }
    public function testCount()
    {
        $query = $this->createQueryBuilder()
            ->from("products")
            ->where("name IN (:name1, :name2)")
            ->setParam("name1", "Product 1")
            ->setParam("name2", "Product 2");
        $this->assertEquals(2, $query->count());
    }

    /**
     * L'appel a count ne doit pas modifier les champs de la première requête
     */
    public function testBugCount()
    {
        $q = $this->createQueryBuilder()->from("products");
        $this->assertEquals(10, $q->count());
        $this->assertEquals("SELECT * FROM products", $q->toSQL());
    }

}
