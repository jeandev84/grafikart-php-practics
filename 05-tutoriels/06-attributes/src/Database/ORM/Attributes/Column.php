<?php
declare(strict_types=1);

namespace Grafikart\Database\ORM\Attributes;

/**
 * Column
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Grafikart\Database\ORM\Attributes
 */
#[\Attribute]
class Column
{
     public function __construct(
         public string $name,
         public string $type,
         public array $options = []
     )
     {
     }
}