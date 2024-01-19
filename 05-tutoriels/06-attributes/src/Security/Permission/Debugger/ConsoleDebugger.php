<?php
declare(strict_types=1);

namespace Grafikart\Security\Permission\Debugger;

use Grafikart\Security\Permission\Contract\Voter;
use Grafikart\Security\User\UserInterface;

/**
 * ConsoleDebugger
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Grafikart\Security\Permission\Debugger
 */
final class ConsoleDebugger implements PermissionDebugger
{

    /**
     * @inheritDoc
    */
    public function debug(Voter $voter, bool $vote, string $permission, UserInterface $user, ?object $subject = null): void
    {
        $classname = get_class($voter);
        $vote      = $vote ? "\e[32myes\e[0m": "\e[31mno\e[0m";
        file_put_contents('php://stdout', "\e[34m$classname : \e[37m $vote on $permission\n");
    }
}