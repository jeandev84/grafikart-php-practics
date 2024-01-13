<?php
declare(strict_types=1);

namespace Grafikart\Security\Permission;

use Grafikart\Security\Permission\Contract\Voter;
use Grafikart\Security\Permission\Debugger\PermissionDebugger;
use Grafikart\Security\User\Contract\UserInterface;

/**
 * Permission
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Grafikart\Security\Permission
*/
final class Permission
{

     /**
      * @var PermissionDebugger|null
     */
     protected ?PermissionDebugger $debugger;


     /**
      * @var Voter[]
     */
     protected array $voters = [];



     /**
      * @param PermissionDebugger|null $debugger
     */
     public function __construct(?PermissionDebugger $debugger = null)
     {
         $this->debugger = $debugger;
     }


     /**
      * @param UserInterface $user
      * @param string $permission
      * @param object|null $subject
      * @return bool
     */
     public function can(UserInterface $user, string $permission, ?object $subject = null): bool
     {
          foreach ($this->voters as $voter) {
              if ($voter->canVote($permission, $subject)) {
                  $vote = $voter->vote($user, $permission, $subject);
                  if ($this->debugger) {
                      $this->debugger->debug($voter, $vote, $permission, $user, $subject);
                  }
                  if ($vote === true) {
                      return true;
                  }
              }
          }

          return false;
     }




     /**
      * @param Voter $voter
      *
      * @return $this
     */
     public function addVoter(Voter $voter): Permission
     {
         $this->voters[] = $voter;

         return $this;
     }




     /**
      * @param Voter[] $voters
      *
      * @return $this
     */
     public function addVoters(array $voters): Permission
     {
         foreach ($voters as $voter) {
             $this->addVoter($voter);
         }

         return $this;
     }
}