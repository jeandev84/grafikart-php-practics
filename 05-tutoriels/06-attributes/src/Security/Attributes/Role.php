<?php
declare(strict_types=1);

namespace Grafikart\Security\Attributes;

/**
 * Role
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Grafikart\Security\Attributes
 */
#[\Attribute]
class Role
{
    public function __construct(
        protected string $name
    )
    {
    }


    /**
     * @return string
    */
    public function getName(): string
    {
        return $this->name;
    }
}