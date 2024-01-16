<?php
declare(strict_types=1);

namespace Grafikart\Database\ORM\Repository\Contract;


/**
 * EntityRepositoryInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Grafikart\Database\ORM\Repository\Contract
 */
interface EntityRepositoryInterface
{
    /**
     * Returns one record by given id
     *
     * @param $id
     *
     * @return object|null
     */
    public function find($id): mixed;






    /**
     * Return one record by given criteria
     *
     * @param array $criteria
     *
     * @param array $oderBy
     *
     * @return object|null
     */
    public function findOneBy(array $criteria, array $oderBy = []): mixed;







    /**
     * Returns all records
     *
     * @return array|object[]|string[]
     */
    public function findAll(): array;










    /**
     * Returns all records by given criteria
     *
     * @param array $criteria
     *
     * @param array $orderBy
     *
     * @param int|null $limit
     *
     * @param int|null $offset
     *
     * @return object[]
    */
    public function findBy(array $criteria, array $orderBy = [], int $limit = null, int $offset = null): mixed;








    /**
     * Returns class name
     *
     * @return string
    */
    public function getClassName(): string;
}