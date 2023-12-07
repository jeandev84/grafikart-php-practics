<?php
declare(strict_types=1);

namespace App\Auth\Security;


use Framework\Security\Auth;
use Framework\Security\User\UserInterface;


/**
 * Created by PhpStorm at 08.12.2023
 *
 * @DatabaseAuth
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package App\Auth\Security
 */
class DatabaseAuth implements Auth
{

    /**
     * @inheritDoc
    */
    public function getUser(): ?UserInterface
    {
        return null;
    }
}