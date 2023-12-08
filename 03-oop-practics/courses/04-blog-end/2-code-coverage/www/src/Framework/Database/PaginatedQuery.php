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
     * @var Query
     */
    protected Query $query;

    public function __construct(Query $query)
    {
        $this->query = $query;
    }





    /**
     * @inheritDoc
     */
    public function getNbResults(): int
    {
        return $this->query->count();
    }




    /**
     * @inheritDoc
     */
    public function getSlice(int $offset, int $length): iterable
    {
        $query = clone $this->query;
        return $query->limit($length, $offset)->fetchAll();
    }
}