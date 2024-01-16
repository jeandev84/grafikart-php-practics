<?php
declare(strict_types=1);

namespace Grafikart\Database\ORM\Query\SQL\Common;


/**
 * ConditionTrait
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Grafikart\Database\ORM\Query\SQL\Common
 */
trait ConditionTrait
{

    /**
     * @var array
    */
    protected array $wheres  = [];



    /**
     * @param string $condition
     *
     * @return $this
    */
    public function wheres(string $condition): static
    {
        $this->wheres[] = $condition;

        return $this;
    }


    public function whereSQL(): string
    {
         return '';
    }
}