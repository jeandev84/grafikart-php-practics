<?php
declare(strict_types=1);

namespace Grafikart\Database\ORM\Query\SQL;

use Grafikart\Database\ORM\Query\Builder;
use Grafikart\Database\ORM\Query\SQL\Common\ConditionTrait;
use Grafikart\Database\ORM\Query\SQL\Common\SettableTrait;

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
    use ConditionTrait, SettableTrait;

    /**
     * @inheritDoc
     */
    public function getSQL(): string
    {

    }
}