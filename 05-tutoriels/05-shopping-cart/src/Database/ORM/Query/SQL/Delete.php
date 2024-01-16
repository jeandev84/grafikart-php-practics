<?php
declare(strict_types=1);

namespace Grafikart\Database\ORM\Query\SQL;

use Grafikart\Database\ORM\Query\Builder;
use Grafikart\Database\ORM\Query\SQL\Common\ConditionTrait;

/**
 * Delete
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Grafikart\Database\ORM\Query\SQL
 */
class Delete extends Builder
{
    use ConditionTrait;

    /**
     * @inheritDoc
    */
    public function getSQL(): string
    {

    }
}