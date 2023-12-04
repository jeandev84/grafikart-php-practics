<?php
declare(strict_types=1);

namespace App\Service;


use App\Database\Connection\QueryBuilder;

/**
 * Created by PhpStorm at 26.11.2023
 *
 * @Table
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Service
 */
class Table
{


    protected QueryBuilder $query;

    /**
     * Request params $_GET
     *
     * @var array
    */
    protected array $queries = [];
    protected array $sortable = [];
    protected array $columns = [];
    protected int $limit = 20;


    public function __construct(QueryBuilder $query, array $queries)
    {
        $this->query   = $query;
        $this->queries = $queries;
    }



    public function sortable(string ...$sortable): self
    {
         $this->sortable = $sortable;

         return $this;
    }



    public function columns(array $columns): self
    {
        $this->columns = $columns;

        return $this;
    }


    /**
     * @param int $limit
     * @return $this
     */
    public function limit(int $limit): self
    {
        $this->limit = $limit;

        return $this;
    }


    public function page(): int
    {
        return $this->queries['page'] ?? 1;
    }


    public function render()
    {
        $page  = $this->page();
        $count = (clone $query)->count();

        if (! empty($this->queries['sort']) && in_array($this->queries['sort'], $this->sortable)) {
            $this->query->orderBy($this->queries['sort'], $this->queries['dir'] ?? 'asc');
        }

        $items = $this->query
                      ->select(array_keys($this->columns))
                      ->limit($this->limit)
                      ->page($page)
                      ->fetchAll();


        $pages = ceil($count / $this->limit);

    }
}