<?php
declare(strict_types=1);


use PHPUnit\Framework\TestCase;


/**
 * Created by PhpStorm at 26.11.2023
 *
 * @QueryBuilderTest
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 */
final class QueryBuilderTest extends TestCase
{

    public function createQueryBuilder(): \App\QueryBuilder
    {
        $connection = new \App\Database\Connection\PdoConnection("sqlite::memory");
        return new \App\QueryBuilder($connection);
    }

    public function getPDO(): PDO
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
        return $pdo;
    }

    public function testSimpleQuery()
    {
        $q = $this->createQueryBuilder()->from("users", "u")->getSQL();
        $this->assertEquals("SELECT * FROM users u", $q);
    }

    public function testOrderBy()
    {
        $q = $this->createQueryBuilder()->from("users", "u")->orderBy("id", "DESC")->getSQL();
        $this->assertEquals("SELECT * FROM users u ORDER BY id DESC", $q);
    }

    public function testMultipleOrderBy()
    {
        $q = $this->createQueryBuilder()
            ->from("users")
            ->orderBy("id", "ezaearz")
            ->orderBy("name", "DESC")
            ->getSQL();
        $this->assertEquals("SELECT * FROM users ORDER BY id, name DESC", $q);
    }

    public function testLimit()
    {
        $q = $this->createQueryBuilder()
            ->from("users")
            ->limit(10)
            ->orderBy("id", "DESC")
            ->getSQL();
        $this->assertEquals("SELECT * FROM users ORDER BY id DESC LIMIT 10", $q);
    }

    public function testOffset()
    {
        $q = $this->createQueryBuilder()
            ->from("users")
            ->limit(10)
            ->offset(3)
            ->orderBy("id", "DESC")
            ->getSQL();
        $this->assertEquals("SELECT * FROM users ORDER BY id DESC LIMIT 10 OFFSET 3", $q);
    }

    public function testPage()
    {
        $q = $this->createQueryBuilder()
            ->from("users")
            ->limit(10)
            ->page(3)
            ->orderBy("id", "DESC")
            ->getSQL();
        $this->assertEquals("SELECT * FROM users ORDER BY id DESC LIMIT 10 OFFSET 20", $q);
        $q = $this->createQueryBuilder()
            ->from("users")
            ->limit(10)
            ->page(1)
            ->orderBy("id", "DESC")
            ->getSQL();
        $this->assertEquals("SELECT * FROM users ORDER BY id DESC LIMIT 10 OFFSET 0", $q);
    }

    public function testCondition()
    {
        $q = $this->createQueryBuilder()
            ->from("users")
            ->where("id > :id")
            ->setParameters("id", 3)
            ->limit(10)
            ->orderBy("id", "DESC")
            ->getSQL();
        $this->assertEquals("SELECT * FROM users WHERE id > :id ORDER BY id DESC LIMIT 10", $q);
    }

    public function testSelect()
    {
        $q = $this->createQueryBuilder()
            ->select("id", "name", "product")
            ->from("users");
        $this->assertEquals("SELECT id, name, product FROM users", $q->getSQL());
    }

    public function testSelectMultiple()
    {
        $q = $this->createQueryBuilder()
            ->select("id", "name")
            ->from("users")
            ->select('product');
        $this->assertEquals("SELECT id, name, product FROM users", $q->getSQL());
    }

    public function testSelectAsArray()
    {
        $q = $this->createQueryBuilder()
            ->select(["id", "name", "product"])
            ->from("users");
        $this->assertEquals("SELECT id, name, product FROM users", $q->getSQL());
    }

    public function testFetch()
    {
        $city = $this->createQueryBuilder()
            ->from("products")
            ->where("name = :name")
            ->setParameters("name", "Product 1")
            ->fetch($this->getPDO(), "city");
        $this->assertEquals("Ville 1", $city);
    }

    public function testFetchWithInvalidRow()
    {
        $city = $this->createQueryBuilder()
            ->from("products")
            ->where("name = :name")
            ->setParameters("name", "azezaeeazazzaez")
            ->fetch($this->getPDO(), "city");
        $this->assertNull($city);
    }
    public function testCount()
    {
        $query = $this->createQueryBuilder()
            ->from("products")
            ->where("name IN (:name1, :name2)")
            ->setParameters("name1", "Product 1")
            ->setParameters("name2", "Product 2");
        $this->assertEquals(2, $query->count($this->getPDO()));
    }

    /**
     * L'appel a count ne doit pas modifier les champs de la première requête
     */
    public function testBugCount()
    {
        $q = $this->createQueryBuilder()->from("products");
        $this->assertEquals(10, $q->count($this->getPDO()));
        $this->assertEquals("SELECT * FROM products", $q->getSQL());
    }

}