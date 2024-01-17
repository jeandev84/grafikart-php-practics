<?php
declare(strict_types=1);

namespace Grafikart\Database\ORM\Repository;

use Grafikart\Database\Connection\Exception\QueryException;
use Grafikart\Database\Connection\PdoConnection;
use Grafikart\Database\Connection\Query;
use Grafikart\Database\ORM\Mapping\ClassMetadata;
use Grafikart\Database\ORM\Query\QueryBuilder;
use Grafikart\Database\ORM\Query\SQL\Select;
use Grafikart\Database\ORM\Repository\Contract\EntityRepositoryInterface;

/**
 * EntityRepository
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Grafikart\Database\ORM\Repository
 */
class EntityRepository implements EntityRepositoryInterface
{

    /**
     * @var PdoConnection
     */
    protected PdoConnection $connection;



    /**
     * @var ClassMetadata
    */
    protected ClassMetadata $metadata;


    /**
     * @var string 
    */
    protected string $entityName;




    /**
     * @param PdoConnection $connection
     * @param ClassMetadata $metadata
    */
    public function __construct(PdoConnection $connection, ClassMetadata $metadata)
    {
        $this->connection = $connection;
        $this->metadata   = $metadata;
        $this->entityName = $metadata->getClassName();
    }




    /**
     * @return QueryBuilder
    */
    public function createNativeQueryBuilder(): QueryBuilder
    {
        return new QueryBuilder($this->connection);
    }


    /**
     * @param string $sql
     * @return Query
    */
    public function createNativeQuery(string $sql): Query
    {
        return $this->connection->query($sql);
    }




    /**
     * @param string $alias
     * @return Select
    */
    public function createQueryBuilder(string $alias): Select
    {
          return $this->createNativeQueryBuilder()
                      ->select()
                      ->from($this->getTableName(), $alias)
                      ->map($this->entityName);
    }






    /**
     * @inheritDoc
    */
    public function find($id): mixed
    {
          return $this->findOneBy([$this->metadata->getIdentityName() => $id]);
    }




    /**
     * @inheritDoc
    */
    public function findOneBy(array $criteria, array $orderBy = []): mixed
    {
          $builder = $this->createQueryBuilder($this->metadata->getTableAlias());
          return $builder->criteria($criteria)->ordersBy($orderBy)->fetch()->one();
    }






    /**
     * @inheritDoc
    */
    public function findAll(): array
    {
        $builder = $this->createQueryBuilder($this->metadata->getTableAlias());
        return $builder->fetch()->all();
    }




    /**
     * @inheritDoc
    */
    public function findBy(array $criteria, array $orderBy = [], int $limit = null, int $offset = null): mixed
    {
        $builder = $this->createQueryBuilder($this->metadata->getTableAlias());
        return $builder->criteria($criteria)
                       ->ordersBy($orderBy)
                       ->limit(intval($limit))
                       ->offset(intval($offset))
                       ->setParameters($criteria)
                       ->fetch()
                       ->all();
    }




    /**
     * @param array $data
     * @return int
    */
    public function create(array $data): int
    {
          $created = $this->createNativeQueryBuilder()
                          ->insert($this->getTableName(), $data)
                          ->execute();

          return $created ? $this->connection->lastInsertId() : 0;
    }




    /**
     * @param array $data
     * @param int $id
     * @return int
    */
    public function update(array $data, int $id): int
    {
        $identityName = $this->metadata->getIdentityName();

        $created = $this->createNativeQueryBuilder()
                        ->update($this->getTableName(), $data)
                        ->where("{$identityName} = :$identityName")
                        ->setParameter($identityName, $id)
                        ->execute();

        return $created ? $this->connection->lastInsertId() : 0;
    }





    /**
     * @inheritDoc
    */
    public function getClassName(): string
    {
        return $this->metadata->getClassName();
    }





    /**
     * @return string
    */
    private function getTableName(): string
    {
        return $this->metadata->getTableName();
    }
}