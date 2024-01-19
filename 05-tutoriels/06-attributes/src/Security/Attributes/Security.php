<?php
declare(strict_types=1);

namespace Grafikart\Security\Attributes;

/**
 * Security
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Grafikart\Security\Attributes
 */
#[\Attribute]
class Security
{
     public function __construct(
         protected array $roles = []
     )
     {
     }
}