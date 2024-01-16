<?php
declare(strict_types=1);

namespace Grafikart\Database\ORM\Query\SQL;

use Grafikart\Database\Connection\PdoConnection;
use Grafikart\Database\ORM\Query\Builder;
use Grafikart\Database\ORM\Query\SQL\Common\ConditionTrait;

/**
 * Select
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Grafikart\Database\ORM\Query\SQL
 */
class Select extends Builder
{

    use ConditionTrait;


    /**
     * @var array
    */
    protected array $selects = [];


    /**
     * @var array
    */
    protected array $from = [];



    /**
     * @var string[]
    */
    protected array $joins = [];



    /**
     * @var array
    */
    protected array $groupBy = [];




    /**
     * @var string[]
    */
    protected array $having = [];




    /**
     * @var string[]
   */
    protected array $orderBy = [];



    /**
     * @var int
     */
    protected int $offset = 0;




    /**s
     * @var int
     */
    protected int $limit = 0;



    /**
     * @var string
     */
    protected string $classMapping;






    /**
     * @param string $columns
     *
     * @return $this
     */
    public function addSelect(string $columns): static
    {
        $this->selects[] = $columns;

        return $this;
    }





    /**
     * @param string $table
     * @param string $alias
     * @return $this
     */
    public function from(string $table, string $alias = ''): static
    {
        $this->from[$table] = ($alias ? "$table $alias" : $table);

        return $this;
    }





    /**
     * @param string $classMapping
     * @return $this
    */
    public function map(string $classMapping): static
    {
         $this->classMapping = $classMapping;

         return $this;
    }





    /**
     * @param string $orderBy
     *
     * @return $this
     */
    public function addOrderBy(string $orderBy): static
    {
        $this->orderBy[] = $orderBy;

        return $this;
    }






    /**
     * @param string $column
     * @param string $direction
     * @return $this
     */
    public function orderBy(string $column, string $direction = 'asc'): static
    {
        return $this->orderBy(sprintf('%s %s', $column, strtoupper($direction)));
    }





    /**
     * @return $this
     */
    public function ordersBy(array $orders): static
    {
        foreach ($orders as $column => $direction) {
            $this->orderBy($column, $direction);
        }

        return $this;
    }




    /**
     * @param string $table
     *
     * @param string $condition
     *
     *
     * @return $this
     */
    public function join(string $table, string $condition): static
    {
        return $this->addJoin(sprintf('JOIN %s ON %s',  $table, $condition));
    }





    /**
     * @param string $join
     *
     * @return $this
     */
    public function addJoin(string $join): static
    {
        $this->joins[] = $join;

        return $this;
    }




    /**
     * @param array $joins
     *
     * @return $this
     */
    public function addJoins(array $joins): static
    {
        foreach ($joins as $table => $joined) {
            [$condition, $type] = array_values($joined);
            $this->join($table, $condition, $type);
        }

        return $this;
    }





    /**
     * @param string $table
     * @param string $condition
     * @return $this
     */
    public function innerJoin(string $table, string $condition): static
    {
        return $this->join($table, $condition, JoinType::INNER);
    }





    /**
     * @param string $table
     * @param string $condition
     * @return $this
     */
    public function leftJoin(string $table, string $condition): static
    {
        return $this->join($table, $condition, JoinType::LEFT);
    }






    /**
     * @param string $table
     * @param string $condition
     * @return $this
     */
    public function rightJoin(string $table, string $condition): static
    {
        return $this->join($table, $condition, JoinType::RIGHT);
    }





    /**
     * @param string $table
     * @param string $condition
     * @return $this
     */
    public function fullJoin(string $table, string $condition): static
    {
        return $this->join($table, $condition, JoinType::FULL);
    }





    /**
     * @param string $column
     *
     * @return $this
     */
    public function groupBy(string $column): static
    {
        $this->groupBy[] = $column;

        return $this;
    }





    /**
     * @param array $columns
     *
     * @return $this
     */
    public function addGroupBy(array $columns): static
    {
        foreach ($columns as $column) {
            $this->groupBy($column);
        }

        return $this;
    }


    /**
     * @param string $condition
     * @return $this
     */
    public function having(string $condition): static
    {
        $this->having[] = $condition;

        return $this;
    }


    /**
     * @param int|null $limit
     * @return $this
     */
    public function limit(?int $limit): static
    {
        $this->limit = $limit;

        return $this;
    }


    /**
     * @param int|null $offset
     * @return $this
     */
    public function offset(?int $offset): static
    {
        $this->offset = $offset;

        return $this;
    }


    /**
     * @inheritDoc
     */
    public function getSQL(): string
    {
        // TODO: Implement getSQL() method.
    }
}