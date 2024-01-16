<?php
declare(strict_types=1);

namespace Grafikart\Database\ORM\Query\SQL;

use Grafikart\Database\ORM\Query\Builder;

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
    protected array $attributes = [];


    /**
     * @var array
    */
    protected array $bindings = [];




    /**
     * @param string $name
     *
     * @param $value
     *
     * @return $this
    */
    public function set(string $name, $value): static
    {
        $this->attributes[$name] = $value;
        $this->bindings[$name]   = ":$name";

        return $this;
    }



    /**
     * @inheritDoc
    */
    public function getSQL(): string
    {
        return '';
    }
}