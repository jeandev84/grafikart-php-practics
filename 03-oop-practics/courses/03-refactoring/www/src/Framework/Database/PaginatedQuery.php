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


    /**
     * @var \PDO
    */
    protected \PDO $pdo;


    /**
     * @var string
    */
    protected string $query;


    /**
     * @var string
    */
    protected string $countQuery;


    /**
     * @var string|null
    */
    protected ?string $entity = null;




    /**
     * @var array
    */
    protected array $params = [];


    public function __construct(
        \PDO $pdo,
        string $query,
        string $countQuery,
        ?string $entity,
        array $params = []
    )
    {
        $this->pdo = $pdo;
        $this->query = $query;
        $this->countQuery = $countQuery;
        $this->entity = $entity;
        $this->params = $params;
    }




    /**
     * @inheritDoc
    */
    public function getNbResults(): int
    {
        if (! empty($this->params)) {
            $query = $this->pdo->prepare($this->countQuery);
            $query->execute($this->params);
            return $query->fetchColumn();
        }

        return $this->pdo->query($this->countQuery)->fetchColumn();
    }



    /**
     * @inheritDoc
    */
    public function getSlice(int $offset, int $length): iterable
    {
        $statement = $this->pdo->prepare($this->query . " LIMIT :offset, :length");
        foreach ($this->params as $key => $param) {
           $statement->bindParam($key, $param);
        }

        $statement->bindParam('offset', $offset, \PDO::PARAM_INT);
        $statement->bindParam('length', $length, \PDO::PARAM_INT);
        if ($this->entity) {
            $statement->setFetchMode(\PDO::FETCH_CLASS, $this->entity);
        }
        $statement->execute();
        return $statement->fetchAll();
    }
}