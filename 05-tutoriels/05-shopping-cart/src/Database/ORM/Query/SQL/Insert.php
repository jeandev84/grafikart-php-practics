<?php
declare(strict_types=1);

namespace Grafikart\Database\ORM\Query\SQL;

use Grafikart\Database\Connection\PdoConnection;
use Grafikart\Database\ORM\Query\Builder;
use Grafikart\Database\ORM\Query\SQL\Common\SettableTrait;

/**
 * Insert
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Grafikart\Database\ORM\Query\SQL
 */
class Insert extends Builder
{

    /**
     * @var array
    */
    protected array $bindings = [];




    /**
     * @param array $attributes
     * @return $this
    */
    public function insert(array $attributes): static
    {
        foreach ($attributes as $name => $value) {
            $this->setParameter($name, $value);
            $this->bindings[$name] = ":$name";
        }

        return $this;
    }





    /**
     * @return array
    */
    public function getColumns(): array
    {
        return array_keys($this->parameters);
    }




    /**
     * @return array
     */
    public function getBindings(): array
    {
        return $this->bindings;
    }





    /**
     * @inheritDoc
    */
    public function getSQL(): string
    {
        $columns = join(', ', $this->getColumns());
        $values  = join(', ', array_values($this->getBindings()));
        return sprintf('INSERT INTO %s (%s) VALUES (%s)', $this->getTableName(), $columns, $values);
    }




    /**
     * @return bool
    */
    public function execute(): bool
    {
         return $this->getQuery()->execute();
    }
}