<?php
declare(strict_types=1);

namespace Grafikart\Database\ORM\Query\SQL;

use Grafikart\Database\ORM\Query\Builder;

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


    /**
     * @inheritDoc
    */
    public function getSQL(): string
    {

    }



    /**
     * @return bool
    */
    public function execute(): bool
    {
        return $this->getQuery()->execute();
    }
}