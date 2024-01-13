<?php
declare(strict_types=1);

namespace Grafikart\Security\User;


/**
 * UserInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Grafikart\Security\User
*/
interface UserInterface
{
     /**
      * The public representation of the user (e.g. a username, an email address, etc.)
      *
      * @return string
     */
     public function getIdentifier(): string;




     /**
      * Returns user password
      *
      * @return string|null
     */
     public function getPassword(): ?string;





    /**
     * Returns user roles
     *
     * @return array
    */
    public function getRoles(): array;




    /**
     * Returns salt for encoding user password
     *
     * @return string|null
    */
    public function getSalt(): ?string;





    /**
     * Erase credentials
     *
     * @return void
    */
    public function eraseCredentials(): void;
}