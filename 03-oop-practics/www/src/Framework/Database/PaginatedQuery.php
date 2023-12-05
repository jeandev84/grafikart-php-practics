<?php
declare(strict_types=1);

namespace Framework\Database;


use Pagerfanta\Adapter\AdapterInterface;

/**
 * Created by PhpStorm at 05.12.2023
 *
 * @PaginatedQuery
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Framework\Database
 */
class PaginatedQuery implements AdapterInterface
{


    protected \PDO $pdo;

    protected string $query;

    protected string $countQuery;

    public function __construct(
        \PDO $pdo,
        string $query,
        string $countQuery
    )
    {
        $this->pdo = $pdo;
        $this->query = $query;
        $this->countQuery = $countQuery;
    }

    /**
     * @inheritDoc
     */
    public function getNbResults(): int
    {
        return $this->pdo->query($this->countQuery)->fetchColumn();
    }



    /**
     * @inheritDoc
    */
    public function getSlice(int $offset, int $length): iterable
    {
        $statement = $this->pdo->prepare($this->query . " LIMIT :offset, :length");
        $statement->bindParam('offset', $offset, \PDO::PARAM_INT);
        $statement->bindParam('length', $length, \PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll();
    }
}