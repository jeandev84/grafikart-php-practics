<?php
declare(strict_types=1);

namespace Grafikart\Database\ORM\Repository;

use Grafikart\Database\Connection\PdoConnection;
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
     * @return string
    */
    private function getTableName(): string
    {
        return $this->metadata->getTableName();
    }




    /**
     * @inheritDoc
    */
    public function find($id): mixed
    {

    }




    /**
     * @inheritDoc
    */
    public function findOneBy(array $criteria, array $oderBy = []): mixed
    {
        // TODO: Implement findOneBy() method.
    }

    /**
     * @inheritDoc
     */
    public function findAll(): array
    {
        // TODO: Implement findAll() method.
    }

    /**
     * @inheritDoc
     */
    public function findBy(array $criteria, array $orderBy = [], int $limit = null, int $offset = null): mixed
    {
        // TODO: Implement findBy() method.
    }

    /**
     * @inheritDoc
     */
    public function getClassName(): string
    {
        // TODO: Implement getClassName() method.
    }
}