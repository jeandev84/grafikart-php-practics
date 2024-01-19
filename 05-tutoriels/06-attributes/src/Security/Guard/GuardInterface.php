<?php
declare(strict_types=1);

namespace Grafikart\Security\Guard;


/**
 * GuardInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Grafikart\Security\Guard
 */
interface GuardInterface
{
    public function denyAccessUnless(string|array $roles);
}