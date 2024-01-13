<?php
declare(strict_types=1);

namespace Grafikart\Security\Permission\Contract;


use Grafikart\Security\User\Contract\UserInterface;

/**
 * Voter
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Grafikart\Security\Permission\Contract
*/
interface Voter
{
    const EDIT = 'edit';



    /**
     * Determine if voter can vote
     *
     * @param string $permission
     * @param object|null $subject
     * @return bool
    */
    public function canVote(string $permission, ?object $subject = null): bool;




    /**
     * @param UserInterface $user
     * @param string $permission
     * @param object|null $subject
     * @return bool
    */
    public function vote(UserInterface $user, string $permission, ?object $subject = null): bool;
}