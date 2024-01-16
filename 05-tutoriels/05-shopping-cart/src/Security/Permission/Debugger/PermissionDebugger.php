<?php
declare(strict_types=1);

namespace Grafikart\Security\Permission\Debugger;


use Grafikart\Security\Permission\Contract\Voter;
use Grafikart\Security\User\UserInterface;

/**
 * PermissionDebugger
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Grafikart\Security\Permission\Debugger
*/
interface PermissionDebugger
{

    /**
     * @param Voter $voter
     * @param bool $vote
     * @param string $permission
     * @param UserInterface $user
     * @param object|null $subject
     * @return void
     */
     public function debug(Voter $voter, bool $vote, string $permission, UserInterface $user, ?object $subject = null): void;
}