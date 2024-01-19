<?php
declare(strict_types=1);

namespace Grafikart\Database\ORM\Query\SQL;

use Grafikart\Database\ORM\Query\Builder;

/**
 * Update
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Grafikart\Database\ORM\Query\SQL
 */
class Update extends Builder
{

    /**
     * @var array
    */
    protected array $bindings = [];



    /**
     * @param array $attributes
     * @return $this
    */
    public function update(array $attributes): static
    {
        foreach ($attributes as $name => $value) {
            $this->set($name, $value);
        }

        return $this;
    }


    /**
     * @param string $name
     * @param $value
     * @return $this
    */
    public function set(string $name, $value): static
    {
        $this->setParameter($name, $value);
        $this->bindings[$name] = "$name = :$name";

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function getSQL(): string
    {
        $sql[] = "UPDATE {$this->getTableName()}";
        $sql[] = "SET ". join(', ', array_values($this->bindings));
        $sql[] = $this->whereSQL();

        return join(' ', array_filter($sql));
    }


    /**
     * @return bool
    */
    public function execute(): bool
    {
        return $this->getQuery()->execute();
    }
}