<?php
declare(strict_types=1);

namespace Grafikart\Security\User\Token;

use Grafikart\Security\User\UserInterface;

/**
 * UserToken
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Grafikart\Security\User\Token
 */
class UserToken implements UserTokenInterface
{


    /**
     * @var UserInterface
     */
    protected UserInterface $user;


    /**
     * @param UserInterface $user
     */
    public function __construct(UserInterface $user)
    {
        $this->user = $user;
    }




    /**
     * @return string
    */
    public function serialize(): string
    {
         return serialize($this->user);
    }





    /**
     * @inheritDoc
    */
    public function getUser(): UserInterface
    {
        return $this->user;
    }
}